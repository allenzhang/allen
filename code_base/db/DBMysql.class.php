<?PHP
/**
 * @file          /code_base2/db/DBMysql.class.php
 * @author        allen
 * @date          2013-07-18
 * 数据库操作的类库
 */

require_once(dirname(__FILE__) . '/../datetime/DateTimeUtil.class.php');

define('SLOW_QUERY_MIN',50);
define('SLOW_QUERY_SAMPLE',500);

/**
 * @class: DBConst
 * @PURPOSE:  DBConst 可以认为是一个名字空间， 其中定义了若干数据库相关的常量， 如编码等
 */
class DBConst {
    // 数据库编码相关
    const ENCODING_GBK      = 0; ///< GBK 编码定义
    const ENCODING_UTF8     = 1; ///< UTF8 编码定义
    const ENCODING_LATIN    = 2; ///< LATIN1 编码定义

}

/**
 * @class: DBMysql
 * @PURPOSE:  DBMysql 可以认为是一个名字空间， 其中定义了若干操作数据库的静态方法
 */
class DBMysql {

    /**
     * 已打开的db handle
     * @var array
     */
    private static $_HANDLE_ARRAY   = array();

    private static function _getHandleKey($params) {
        ksort($params);
        return md5(implode('_' , $params));
    }

    /// 根据数据库表述的参数获取数据库操作句柄
    /// @param[in] array $db_config_array, 是一个array类型的数据结构，必须有host, username, password 三个熟悉, port为可选属性， 缺省值分别为3306
    /// @param[in] string $db_name, 数据库名称
    /// @param[in] enum $encoding, 从$DBConst中数据库编码相关的常量定义获取, 有缺省值 $DBConst::ENCODING_UTF8
    /// @return 非FALSE表示成功获取hadnle， 否则返回FALSE
    public static function createDBHandle($db_config_array, $db_name, $encoding = DBConst::ENCODING_UTF8) {

        $db_config_array['db_name']     = $db_name;
        $db_config_array['encoding']    = $encoding;
        $handle_key = self::_getHandleKey($db_config_array);

        if (isset(self::$_HANDLE_ARRAY[$handle_key])) {
            return self::$_HANDLE_ARRAY[$handle_key];
        }

        $port = 3306;
        do {
            if (!is_array($db_config_array))
                break;
            if (!is_string($db_name))
                break;
            if (strlen($db_name) == 0)
                break;
            if (!array_key_exists('host', $db_config_array))
                break;
            if (!array_key_exists('username', $db_config_array))
                break;
            if (!array_key_exists('password', $db_config_array))
                break;
            if (array_key_exists('port', $db_config_array)) {
                $port = (int)($db_config_array['port']);
                if (($port < 1024) || ($port > 65535))
                    break;
            }
            $host = $db_config_array['host'];
            if (strlen($host) == 0)
                break;
            $username = $db_config_array['username'];
            if (strlen($username) == 0)
                break;
            $password = $db_config_array['password'];
            if (strlen($password) == 0)
                break;

            $handle = @mysqli_connect($host, $username, $password, $db_name, $port)  or die("Error " . mysqli_error($handle));
            // 如果连接失败，再重试2次
            for ($i = 1; ($i < 3) && (FALSE === $handle); $i++) {
                // 重试前需要sleep 50毫秒
                usleep(50000);
                $handle = @mysqli_connect($host, $username, $password, $db_name, $port);
            }
            //$conn_time = DateTimeUtil::getMicrosecond() - $conn_time;
            if (FALSE === $handle)
                break;

            $is_encoding_set_success = true;
            switch ($encoding)  {
                case DBConst::ENCODING_UTF8 :
                        $is_encoding_set_success = mysqli_set_charset($handle, "utf8");
                    break;
                case DBConst::ENCODING_GBK :
                        $is_encoding_set_success = mysqli_set_charset($handle, "gbk");
                    break;
                default:
            }
            if (FALSE === $is_encoding_set_success) {
                mysqli_close($handle);
                break;
            }
            self::$_HANDLE_ARRAY[$handle_key]    = $handle;
            return $handle;
        } while (FALSE);
        // to_do, 连接失败，需要记log
        $password_part = substr($password,0,5) . '...';
        $logArray = $db_config_array;
        $logArray['password'] = $password_part;
        self::logError( sprintf("Connect failed:db_config_array=%s", var_export($logArray, true)), 'mysqlns.connect');
        return FALSE;
    }

    /// 释放通过getDBHandle或者getDBHandleByName 返回的句柄资源
    /// @param[in] handle $handle, 你懂的
    /// @return void
    public static function releaseDBHandle($handle) {
        if (!self::_checkHandle($handle))
            return;
        foreach (self::$_HANDLE_ARRAY as $handle_key => $handleObj) {
            if ($handleObj->thread_id == $handle->thread_id) {
                unset(self::$_HANDLE_ARRAY[$handle_key]);
            }
        }
        mysqli_close($handle);
    }

    /// 执行sql语句， 该语句必须是insert, update, delete, create table, drop table等更新语句
    /// @param[in] handle $handle, 操作数据库的句柄
    /// @param[in] string $sql, 具体执行的sql语句
    /// @return TRUE:表示成功， FALSE:表示失败
    public static function execute($handle, $sql) {
        if (!self::_checkHandle($handle))
            return FALSE;
        $tm = DateTimeUtil::getMicrosecond();
        if (mysqli_query($handle, $sql)) {
            $tm_used = intval( DateTimeUtil::getMicrosecond() - $tm);
            if( $tm_used > SLOW_QUERY_MIN && rand(0,SLOW_QUERY_SAMPLE) == 1) {
                self::logWarn( "seconds=$tm_used, SQL=$sql", 'mysqlns.slow' );
            }
            return TRUE;
        }
        // to_do, execute sql语句失败， 需要记log
        self::logError( "SQL Error: $sql," . self::getLastError($handle), 'mysqlns.sql');

        return FALSE;
    }

    /// 执行insert sql语句，并获取执行成功后插入记录的id
    /// @param[in] handle $handle, 操作数据库的句柄
    /// @param[in] string $sql, 具体执行的sql语句
    /// @return FALSE表示执行失败， 否则返回insert的ID
    public static function insertAndGetID($handle, $sql) {
        if (!self::_checkHandle($handle))
            return false;
        do {
            if (mysqli_query($handle, $sql) === FALSE)
                break;
            if (($result = mysqli_query($handle, 'select LAST_INSERT_ID() AS LastID')) === FALSE)
                break;
            $row = mysqli_fetch_assoc($result);
            $lastid = $row['LastID'];
            mysqli_free_result($result);
            return $lastid;
        } while (FALSE);
        // to_do, execute sql语句失败， 需要记log
        self::logError( "SQL Error: $sql," . self::getLastError($handle), 'mysqlns.sql');
        return FALSE;
    }

    /// 将所有结果存入数组返回
    /// @param[in] handle $handle, 操作数据库的句柄
    /// @param[in] string $sql, 具体执行的sql语句
    /// @return FALSE表示执行失败， 否则返回执行的结果, 结果格式为一个数组，数组中每个元素都是mysqli_fetch_assoc的一条结果
    public static function query($handle, $sql) {
        if (!self::_checkHandle($handle))
            return FALSE;
        do {
            $tm = DateTimeUtil::getMicrosecond();
            if (($result = mysqli_query($handle, $sql)) === FALSE)
                break;
            $tm_used = intval( DateTimeUtil::getMicrosecond() - $tm);
            if( $tm_used > SLOW_QUERY_MIN && rand(0,SLOW_QUERY_SAMPLE) == 1) {
                self::logWarn( "seconds=$tm_used, SQL=$sql", 'mysqlns.slow' );
            }

            $res = array();
            while($row = mysqli_fetch_assoc($result)) {
                $res[] = $row;
            }
            mysqli_free_result($result);
            return $res;
        } while (FALSE);

        // to_do, execute sql语句失败， 需要记log
        self::logError( "SQL Error: $sql," . self::getLastError($handle), 'mysqlns.sql');

        return FALSE;
    }

    /// 将查询的第一条结果返回
    /// @param[in] handle $handle, 操作数据库的句柄
    /// @param[in] string $sql, 具体执行的sql语句
    /// @return FALSE表示执行失败， 否则返回执行的结果, 执行结果就是mysqli_fetch_assoc的结果
    public static function queryFirst($handle, $sql) {
        if (!self::_checkHandle($handle))
            return FALSE;
        do {
            $tm = DateTimeUtil::getMicrosecond();
            if (($result = mysqli_query($handle, $sql)) === FALSE)
                break;
            $tm_used = intval( DateTimeUtil::getMicrosecond() - $tm);
            if( $tm_used > SLOW_QUERY_MIN && rand(0,SLOW_QUERY_SAMPLE) == 1) {
                self::logWarn( "seconds=$tm_used, SQL=$sql", 'mysqlns.slow' );
            }

            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return $row;
        } while (FALSE);
        // to_do, execute sql语句失败， 需要记log
        self::logError( "SQL Error: $sql," . self::getLastError($handle), 'mysqlns.sql');
        return FALSE;
    }

    /**
     * 将所有结果存入数组返回
     * @param Mysqli $handle 句柄
     * @param string $sql 查询语句
     * @return FALSE表示执行失败， 否则返回执行的结果, 结果格式为一个数组，数组中每个元素都是mysqli_fetch_assoc的一条结果
     */
    public static function getAll($handle , $sql) {
        return self::query($handle, $sql);
    }

    /**
     * 将查询的第一条结果返回
     * @param[in] Mysqli $handle, 操作数据库的句柄
     * @param[in] string $sql, 具体执行的sql语句
     * @return FALSE表示执行失败， 否则返回执行的结果, 执行结果就是mysqli_fetch_assoc的结果
     */
    public static function getRow($handle , $sql) {
        return self::queryFirst($handle, $sql);
    }

    /**
     * 查询第一条结果的第一列
     * @param Mysqli $handle, 操作数据库的句柄
     * @param string $sql, 具体执行的sql语句
     */
    public static function getOne($handle , $sql) {
        $row    = self::getRow($handle, $sql);
        if (is_array($row))
            return current($row);
        return $row;
    }

    /// 得到最近一次操作影响的行数
    /// @param[in] handle $handle, 操作数据库的句柄
    /// @return FALSE表示执行失败， 否则返回影响的行数
    public static function lastAffected($handle) {
        if (!self::_checkHandle($handle))
            return FALSE;
        $affected_rows = mysqli_affected_rows($handle);
        if ($affected_rows < 0)
            return FALSE;
        return $affected_rows;
    }

    /// 得到最近一次操作错误的信息
    /// @param[in] handle $handle, 操作数据库的句柄
    /// @return FALSE表示执行失败， 否则返回 'errorno: errormessage'
    public static function getLastError($handle) {
        if (!self::_checkHandle($handle))
            return FALSE;
        if(mysqli_errno($handle)) {
            return mysqli_errno($handle).': '.mysqli_error($handle);
        }
        return FALSE;
    }

    /**
     * @brief 检查handle
     * @param[in] handle $handle, 操作数据库的句柄
     * @return boolean true|成功, false|失败
     */
    private static function _checkHandle($handle) {
        if (!is_object($handle)) {
            self::logError(sprintf("handle Error: handle='%s'",var_export($handle, true)), 'mysqlns.handle');
            return false;
        }
        return true;
    }

    /// 记录统一的错误日志
    /// @param[in] string $message, 错误消息
    /// @param[in] string $category, 错误的子类别
    protected static function logError($message, $category) {
        if( class_exists('Logger') ) {
            Logger::logError( $message, $category );
        }
    }

    /// 记录统一的警告日志
    /// @param[in] string $message, 错误消息
    /// @param[in] string $category, 错误的子类别
    protected static function logWarn($message, $category) {
        if( class_exists('Logger') ) {
            Logger::logWarn( $message, $category );
        }
    }


}
