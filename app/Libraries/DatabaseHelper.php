<?php 

namespace App\Libraries;

use CodeIgniter\Database\BaseConnection;

class DatabaseHelper
{
    protected $db;

    public function __construct()
    {
    	$this->db = \Config\Database::connect();
    }

    // Get Row
    public function getRow($table, $id)
    {
        return $this->db->table($table)->where('id', cleanNumber($id))->get()->getRow();
    }

    // Get Result
    public function getResult($table)
    {
        return $this->db->table($table)->orderBy('id DESC')->get()->getResult();
    }

    // Get Result Array
    public function getResultArray($table)
    {
    	return $this->db->table($table)->orderBy('id DESC')->get()->getResultArray();
    }

    // countAll
    public function countAll($table, $like = [])
    {
    	//return $this->db->table($table)->countAll();
    	// $db->table('my_table')->like('title', 'match')->countAll();
    	return $this->db->table($table)->countAll();
    }

    // countAllResults
    public function countAllResults($table, $like = [])
    {
    	//return $this->db->table($table)->countAll();
    	// $db->table('my_table')->like('title', 'match')->countAllResults();
    	return $this->db->table($table)->countAllResults();
    }

    // query
    public function query($data, $type = '')
    {
    	$query = $this->db->query($data);
    	//$results = $query->getResult();
    	//$results = $query->getResultArray();
    	//$row     = $query->getRow();
    	return $query->getResult();
    }

    //
    public function select($table, $columns = [])
    {
    	return $this->db->table($table)->select($columns)->get()->getResultArray();
    }

    // Insert
    public function insert($table, $data = [])
    {
    	return $this->db->table($table)->insert($data);
    }

    // Update
    public function update($table, $id, $data = [])
    {
    	return $this->db->table($table)->where('id', cleanNumber($id))->update($data);
    }

    // Delete
    public function delete($table, $id)
    {
    	return $this->db->table($table)->where('id', cleanNumber($id))->delete();
    }
    
    // Get Platform
    public function getPlatform()
    {
    	return $this->db->getPlatform();
    }

    // Get Version
    public function getVersion()
    {
    	return $this->db->getVersion();
    }

    // clean string
	public function cleanStr($str)
    {
        $str = strTrim($str);
        $str = removeSpecialCharacters($str);
        return esc($str);
    }

	// clean number
	public function cleanNumber($num)
    {
        $num = strTrim($num);
        $num = esc($num);
        if (empty($num)) {
            return 0;
        }
        return intval($num);
    }

    // Remove Forbidden Characters
    public function removeForbiddenCharacters($str)
    {
        $str = strTrim($str);
        $str = strReplace(';', '', $str);
        $str = strReplace('"', '', $str);
        $str = strReplace('$', '', $str);
        $str = strReplace('%', '', $str);
        $str = strReplace('*', '', $str);
        $str = strReplace('/', '', $str);
        $str = strReplace('\'', '', $str);
        $str = strReplace('<', '', $str);
        $str = strReplace('>', '', $str);
        $str = strReplace('=', '', $str);
        $str = strReplace('?', '', $str);
        $str = strReplace('[', '', $str);
        $str = strReplace(']', '', $str);
        $str = strReplace('\\', '', $str);
        $str = strReplace('^', '', $str);
        $str = strReplace('`', '', $str);
        $str = strReplace('{', '', $str);
        $str = strReplace('}', '', $str);
        $str = strReplace('|', '', $str);
        $str = strReplace('~', '', $str);
        $str = strReplace('+', '', $str);

        return $str;
    }

    // Remove Special Characters
    public function removeSpecialCharacters($str, $removeQuotes = false)
    {
        $str = removeForbiddenCharacters($str);
        $str = strReplace('#', '', $str);
        $str = strReplace('!', '', $str);
        $str = strReplace('(', '', $str);
        $str = strReplace(')', '', $str);
        if ($removeQuotes) {
            $str = clrQuotes($str);
        }
        return $str;
    }

    //
    public function clrQuotes($str)
    {
        $str = strReplace('"', '', $str);
        $str = strReplace("'", '', $str);
        return $str;
    }
}
