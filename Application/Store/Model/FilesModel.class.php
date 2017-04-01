<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/20
 * Time: 10:41
 */

namespace Store\Model;


use Think\Model;

class FilesModel extends Model {

    public function findFirst($pkValues){
        $this -> field( 'aliasFileName', 'attachedDocumentId', 'documentId', 'entityName', 'existFlag', 'fileName', 'folderPath', 'lookupCode', 'lookupType', 'pageNum', 'pageSize', 'publishFlag', 'scaleExistFlag', 'scaleFileName', 'seqNum', 'url')
        ->where('attachId='.$pkValues) -> limit(1) ->select();
    }
}