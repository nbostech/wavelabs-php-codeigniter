<?php
/**
 * Description of DataModel
 *
 * @author Sastry
 */
class DataModel extends CI_Model {

    protected $table_name = null;
    protected $primary_key = null;
    protected $_rules = array(
        'required' => array(),
        'string' => array(),
        'email' => array(),
        'date' => array(),
        'integer' => array()
    );
    protected $relations = [];

    function __construct() {
        parent::__construct();
    }

    function search($mode = '') {
        return false;
    }

    public function attributeLabels() {
        return array();
    }

    public function rules() {
        return array();
    }

    function insert($pdata = array()) {
        /*if (!empty($pdata['created']) && stripos($pdata['created'], "NOW") !== false) {
            $this->db->set('created', $pdata['created'], FALSE);
            unset($pdata['created']);
        }*/
        $this->db->insert($this->table_name, $pdata);
        return $this->db->insert_id();
    }

    function add($pdata = array()) {
        $this->insert($pdata);
    }

    function updateByPk($pk_val, $pdata = array()) {
        $this->db->where($this->primary_key, $pk_val);
        return $this->db->update($this->table_name, $pdata);
    }

    function updateById($pk_val, $pdata = array()) {
        $this->updateByPk($pk_val, $pdata);
    }

    function update($condition, $pdata = array()) {
        $this->db->where($condition, false);
        return $this->db->update($this->table_name, $pdata);
    }

    function deleteByPk($pk_val) {
        $this->db->where($this->primary_key, $pk_val);
        return $this->db->delete($this->table_name);
    }

    function delete($condition) {
        $this->db->where($condition, false);
        return $this->db->delete($this->table_name);
    }

    public function insertFormData($pdata = array()) {
        $data = array();
        $labels = $this->attributeLabels();
        if (is_array($labels) && count($labels) > 0) {
            $this->_rules = $this->rules() + $this->_rules;
            foreach ($labels as $key => $label) {
                if (in_array($key, $this->_rules['date']))
                    $data[$key] = dateForm2DB($pdata[$key]);
                else if (isset($pdata[$key]))
                    $data[$key] = trim($pdata[$key]);
            }
        }
        if (isset($labels['created']))
            $this->db->set('created', "NOW()", FALSE);
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function updateFormDataByPk($pk_val, $pdata = array()) {
        $data = array();
        $labels = $this->attributeLabels();
        if (is_array($labels) && count($labels) > 0) {
            $this->_rules = $this->rules() + $this->_rules;
            foreach ($labels as $key => $label) {
                if (in_array($key, $this->_rules['date']))
                    $data[$key] = dateForm2DB($pdata[$key]);
                else if (isset($pdata[$key]))
                    $data[$key] = trim($pdata[$key]);
            }
        }
        $this->db->where($this->primary_key, $pk_val);
        if (isset($labels['updated']))
            $this->db->set('updated', "NOW()", FALSE);
        return $this->db->update($this->table_name, $data);
    }

    public function updateFormData($condition, $pdata = array()) {
        $data = array();
        $labels = $this->attributeLabels();
        if (is_array($labels) && count($labels) > 0) {
            $this->_rules = $this->rules() + $this->_rules;
            foreach ($labels as $key => $label) {
                if (in_array($key, $this->_rules['date']))
                    $data[$key] = dateForm2DB($pdata[$key]);
                else if (isset($pdata[$key]))
                    $data[$key] = trim($pdata[$key]);
            }
        }
        $this->db->where($condition);
        if (isset($labels['updated']))
            $this->db->set('updated', "NOW()", FALSE);
        return $this->db->update($this->table_name, $data);
    }

    function getById($pk_val) {
        $this->db->select("*");
        $this->db->where($this->primary_key, $pk_val);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function getByPk($pk_val){
        return $this->getById($pk_val);
    }

    function find($condition = "") {
        $this->db->select("*");
        if(!empty($condition)){
            $this->db->where($condition);
        }
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            if(!empty($this->relations)){
                foreach($this->relations as $relation_key => $relation){
                    $row[$relation_key] = [];
                    $this->db->select("*");
                    $this->db->where($relation[0].".".$relation[1], $row[$this->primary_key]);
                    $query = $this->db->get($relation[0]);
                    if ($query->num_rows() > 0) {
                        $row[$relation_key] = $query->result_array();
                    }
                }
            }
            return $row;
        }
        return false;
    }

    function findAll($condition = "") {
        $this->db->select("*");
        if(!empty($condition)){
            $this->db->where($condition);
        }
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            $rows = $query->result_array();
            foreach($rows as $row){

            }
            return $rows;
        }
        return false;
    }

}

?>