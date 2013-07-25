<?PHP
$GLOBALS['CODEBASE_ROOT'] = dirname(__FILE__) . '/../../../';
/*
class DBMysqlConfig {
    static $DB = array (
        'host'          => '192.168.9.98',
        'username'      => 'test',
        'password'      => 'test',
        'port'          => 3306,
        'desc'          => 'test',
        'monitor_db'    => 'null'
    );

    static $ERROR_DB = array (
        'host'          => '192.168.9.98',
        'username'      => 'test',
        'password'      => 'test',
        'port'          => 3308,    ///< this port can not access mysql services
        'desc'          => 'test',
        'monitor_db'    => 'null'
    );

}
*/
include_once dirname(__FILE__) . '/../DBMysqlNamespace.class.php';

class DBMysqlNamespaceTest extends PHPUnit_Framework_TestCase {
    var $dbname = 'test';
    var $encoding = DBConstNamespace::ENCODING_UTF8;
    
	public function setUp() {

        $handle = DBMysqlNamespace::createDBHandle(DBMysqlConfig::$DB, $this->dbname, $this->encoding);
        $arg = is_bool($handle) && ($handle === FALSE);
        $this->assertEquals($arg, FALSE);
        
        $sql = 'create table if not exists tb_unittest(id int NOT NULL auto_increment,c1 int, PRIMARY KEY (id) )';
        $ret = DBMysqlNamespace::execute($handle, $sql);
        $this->assertEquals($ret, TRUE);
        
        $this->handle = $handle;
	}
    
    public function tearDown() {
        $sql = 'drop table if exists tb_unittest';
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $this->assertEquals($ret, TRUE);
        DBMysqlNamespace::releaseDBHandle($this->handle);
    }
	
	public function test_getDBHandle() {
        $dbname = 'test';
        $encoding = DBConstNamespace::ENCODING_UTF8;
        //$handle = DBMysqlNamespace::createDBHandle(DBMysqlConfig::$DB, $dbname, $encoding);
        //$arg = is_bool($handle) && ($handle === FALSE);
        //$this->assertEquals($arg, FALSE);
        //DBMysqlNamespace::releaseDBHandle($handle);

        $handle = DBMysqlNamespace::createDBHandle(DBMysqlConfig::$ERROR_DB, $dbname, $encoding);
        $this->assertEquals($handle, FALSE);
	}

    public function test_execute() {
        $sql = 'create table tb_unittest(c1 int)';
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $this->assertEquals($ret, FALSE);
    }
    
    public function test_insertAndGetID() {
        $sql = 'alter table tb_unittest auto_increment=4000';
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $this->assertEquals($ret, TRUE);
        
        $sql = 'insert into tb_unittest(c1) values (100)';
        $ret = DBMysqlNamespace::insertAndGetID($this->handle, $sql);
        $this->assertEquals($ret, 4000);
    }

    public function test_query() {
        $sql = 'insert into tb_unittest(c1) values (100)'; 
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $this->assertEquals($ret, TRUE);
        
        $sql = 'select c1 from tb_unittest';
        $ret = DBMysqlNamespace::query($this->handle, $sql);
        $this->assertEquals(count($ret), 2);

    }

    public function test_queryFrist() {
        $sql = 'insert into tb_unittest(c1) values (100)';
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $this->assertEquals($ret, TRUE);

        $sql = 'select id,c1 from tb_unittest';
        $ret = DBMysqlNamespace::queryFirst($this->handle, $sql);
        $this->assertEquals($ret, array( "id" => 1 , "c1" => 100 ) );
    }

    public function test_lastAffected() {
        $sql = 'insert into tb_unittest(c1) values (100)';
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $this->assertEquals($ret, TRUE);
        $ret = DBMysqlNamespace::lastAffected($this->handle);
        $this->assertEquals($ret, 1);
        
        $sql = 'delete from tb_unittest';
        $ret = DBMysqlNamespace::execute($this->handle, $sql);
        $this->assertEquals($ret, TRUE);
        $ret = DBMysqlNamespace::lastAffected($this->handle);
        $this->assertEquals($ret, 2);
    }

    public function test_multiInstance() {
        
        $h1 = DBMysqlNamespace::createDBHandle(DBMysqlConfig::$DB, $this->dbname, $this->encoding);
        //print_r( $h1 );
        $arg = is_bool($h1) && ($h1 === FALSE);
        $this->assertEquals($arg, FALSE);
        
        DBMysqlNamespace::releaseDBHandle( $h1 );

    }
}

?>
