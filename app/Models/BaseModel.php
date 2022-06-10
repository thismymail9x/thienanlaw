<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;

class BaseModel extends Model
{
    protected $table = '';
    protected $primaryKey = '';
    /*autoIncrement*/
    protected $useAutoIncrement = false;
    /*for delete logical*/
    protected $useSoftDeletes = true;
    /*the type of data that is returned
    */
    protected $returnType = 'array';// or 'object'
    protected $protectFields = true;
    //Dates
    //protected $useTimestamps        = false;
    //protected $dateFormat           = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    /*Validating data
    */
    protected $skipValidation = false;
    // Callbacks
    protected $allowCallbacks = true;
    protected $afterInsert = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
    protected $beforeInsert = ['beforeInsert'];//defined below
    protected $beforeUpdate = ['beforeUpdate'];//defined below

    /**
     * Instance of the encrypter object.
     *
     */
    protected $encrypter;

    /**
     * Called during initialization. Appends
     * our custom field to the module's model.
     */
    protected function initialize()
    {
        $this->utils = new Utils(); // create an instance of Utils-Library class
        $this->encrypter = \Config\Services::encrypter(); // create an instance of Encrypter class
    }

    /*for save by conditions*/
    public function updateDataByConditions($conditions, $dataUpdates)
    {
        if (empty($conditions) == false) {
            $this->where($conditions);
        }
        $countUpdated = $this->countAllResults(false);

        if ($countUpdated > 0) {
            $this->set($dataUpdates);
            $this->update();
        }
        return $countUpdated;
    }

    /**
     * @param $condition
     * @param $values
     * @param $dataUpdates
     * @return mixed
     * @throws \ReflectionException
     * update multi by condition
     */
    public function updateMultiCondition($condition, $values, $dataUpdates)
    {
        if (empty($condition) == false) {
            $this->whereIn($condition, $values);
        }

        $countUpdated = $this->countAllResults(false);

        if ($countUpdated > 0) {
            $this->set($dataUpdates);
            $this->update();
        }
        return $countUpdated;
    }

    /*for save by array ids*/
    public function updateDataByIds($ids, $dataUpdates)
    {
        if (empty($ids) == false) {
            $this->whereIn($this->primaryKey, $ids);
        }

        $countUpdated = $this->countAllResults(false);

        if ($countUpdated > 0) {
            $this->set($dataUpdates);
            $this->update();
        }

        return $countUpdated;
    }

    public function getByIds($ids)
    {
        if (empty($ids) == false) {
            $this->whereIn($this->primaryKey, $ids);
        }

        return $this->get()->getResultArray();
    }


    /* delete by conditions */
    public function deleteByConditions($conditions)
    {
        $this->where($conditions);
        $this->delete();
    }

    /*delete by one-id*/
    public function deleteById($id)
    {
        $this->delete($id);
    }

    /*delete by multi-ids*/
    public function deleteMultiIds($arrIds)
    {
        $this->whereIn($this->primaryKey, $arrIds)->delete();
    }

    /*get by multi-conditions
    * to except the deleted-logical records
    * @param:
    * $conditions: array of condition, ex: 'id' => '123'
    * using this method, we must put condition: deleted_at is null
    * Optional $limit is number, $orderBy is 'name of field' + $inc = 'desc' or 'asc'
    * $withSelect,  $withJoinTable + $withJoinConditions, $groupBy
    * @return array results by
    */
    public function getByConditions($conditions, $limit = 0, $orderBy = '', $inc = 'desc', $withSelect = '',
                                    $withJoinTable = '', $withJoinConditions = '',
                                    $groupBy = '', $distinct = 0, $offset = 0)
    {

        if ($distinct != 0) {
            $this->distinct();
        }
        if ($offset != 0) {
            $this->offset($offset);
        }
        if ($withSelect != '') {
            $this->select($withSelect);
        }
        if ($withJoinTable != '' && $withJoinConditions != '') {
            $this->join($withJoinTable, $withJoinConditions);
        }
        $this->where($conditions);
        if ($groupBy != '') {
            $this->groupBy($groupBy);
        }
        if ($orderBy != '') {
            $this->orderBy($orderBy, $inc);
        }
        if ($limit > 0) {
            $this->limit($limit);
        }
        return $this->get()->getResultArray();
    }
    public function getByConditions_v2($conditions, $withSelect = '', $withJoinTable = '', $withJoinConditions = '',
                                       $conditionIn='',$whereInBy='',
                                       $conditionNotIn='',$whereNotInBy='',
                                       $inc = 'desc',$groupBy = '',
                                       $limit = 0, $distinct = 0, $offset = 0, $orderBy = '')
    {
        if ($distinct != 0) {
            $this->distinct();
        }
        if ($offset != 0) {
            $this->offset($offset);
        }
        if ($withSelect != '') {
            $this->select($withSelect);
        }
        if ($withJoinTable != '' && $withJoinConditions != '') {
            $this->join($withJoinTable, $withJoinConditions);
        }
        if ($conditionIn != '' && $whereInBy !='') {
            $this->whereIn($whereInBy,$conditionIn);
        }
        if ($conditionNotIn != '' && $whereNotInBy !='') {
            $this->whereNotIn($whereNotInBy,$conditionNotIn);
        }
        $this->where($conditions);
        if ($groupBy != '') {
            $this->groupBy($groupBy);
        }
        if ($orderBy != '') {
            $this->orderBy($orderBy, $inc);
        }
        if ($limit > 0) {
            $this->limit($limit);
        }
        return $this->get()->getResultArray();
    }

    /*get by multi-conditions
     * to except the deleted-logical records
     * @param:
     * $conditions: array of condition, ex: 'id' => '123'
     * using this method, we must put condition: deleted_at is null
     * Optional $limit is number, $orderBy is 'name of field' + $inc = 'desc' or 'asc'
     * $withSelect,  $withJoinTable + $withJoinConditions, $groupBy
     * @return the first record from array results by
     *
     */
    public function getFirstByConditions($conditions, $limit = 0, $orderBy = '', $inc = 'desc', $withSelect = '',
                                         $withJoinTable = '', $withJoinConditions = '', $groupBy = '',
                                         $withJoinTable2 = '', $withJoinConditions2 = '', $typeJoin2 = '')
    {
        if ($withSelect != '') {
            $this->select($withSelect);
        }
        if ($withJoinTable != '' & $withJoinConditions != '') {
            $this->join($withJoinTable, $withJoinConditions);//default using inner join
        }
        if ($withJoinTable2 != '' && $withJoinConditions2 != '') {
            if ($typeJoin2 == '') $typeJoin2 = 'inner';
            $this->join($withJoinTable2, $withJoinConditions2, $typeJoin2);
        }
        $this->where($conditions);
        if ($groupBy != '') {
            $this->groupBy($groupBy);
        }
        if ($orderBy != '') {
            $this->orderBy($orderBy, $inc);
        }
        if ($limit > 0) {
            $this->limit($limit);
        }
        return $this->first();
    }

    public function getById($id, $withSelect = '', $withJoinTable = '', $withJoinConditions = '', $typeJoin = '',
                            $withJoinTable2 = '', $withJoinConditions2 = '', $typeJoin2 = '')
    {
        if ($withSelect != '') {
            $this->select($withSelect);
        }
        if ($withJoinTable != '' && $withJoinConditions != '') {
            if ($typeJoin == '') $typeJoin = 'inner';
            $this->join($withJoinTable, $withJoinConditions, $typeJoin);
        }
        if ($withJoinTable2 != '' && $withJoinConditions2 != '') {
            if ($typeJoin2 == '') $typeJoin2 = 'inner';
            $this->join($withJoinTable2, $withJoinConditions2, $typeJoin2);
        }
        $this->where($this->primaryKey, $id);
        return $this->first();
    }

    /*for save data in action: insert/ update */
    public function saveData($data, $id = 0, $setId = 0)
    {
        // clear các thẻ html tránh lỗi xss
        foreach ($data as $key => $value) {
            $data[$key] = strip_tags($value, HTML_ALLOWED_TAGS);
        }
        if ($id > 0) {
            $this->updateDataByConditions([$this->primaryKey => $id], $data);
        } else {
            $id = $setId;
            if($setId==0){
                $id = $this->utils->getTimeStampAsId();
            }
            $data[$this->primaryKey] = $id;
            $this->save($data);
        }
        return $id;
    }
    public function getFirstLikeByConditions($conditions, $limit = 0, $orderBy = '', $inc = 'desc', $withSelect = '',
                                         $withJoinTable = '', $withJoinConditions = '', $groupBy = '')
    {
        if ($withSelect != '') {
            $this->select($withSelect);
        }
        if ($withJoinTable != '' & $withJoinConditions != '') {
            $this->join($withJoinTable, $withJoinConditions);//default using inner join
        }

        $this->like($conditions);
        if ($groupBy != '') {
            $this->groupBy($groupBy);
        }
        if ($orderBy != '') {
            $this->orderBy($orderBy, $inc);
        }
        if ($limit > 0) {
            $this->limit($limit);
        }
        return $this->first();
    }
}