use PHPUnit\Framework\TestCase;
require_once(__DIR__.'/../configuration.php');
load_model('UserModel');

class BookMapperTest extends DatabaseTestCase
{
    /**
     * Prepare data set for database tests
     * 
     * @return \PHPUnit_Extensions_Database_DataSet_ArrayDataSet
     */
    public function getDataSet()
    {
        return $this->createArrayDataSet( array() );
    }    
    
    public function testFetchAll()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }

    public function testFetchByISBN()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }

    public function testInsert()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }

    public function testUpdate()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }

    public function testDelete()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }
}
