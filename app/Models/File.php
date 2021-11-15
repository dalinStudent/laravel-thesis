<?php

namespace App\Models;
class File extends Model
{
    protected $table = "files";
    protected $fillable = [
        'file_type',
        'object_type'
    ];
    const FOLDER_WEB = 'web';
    const FOLDER_MOBILE = 'mobile';
    
    const OBJECT_TYPE_TMP = 'tmp';
    const OBJECT_TYPE_PROJECT = 'project';
    const OBJECT_TYPE_STAFF = 'employee';
    const OBJECT_TYPE_PROJECT_SETTING = 'project_setting';
    const OBJECT_TYPE_EMPLOYEE_SETTING = 'employee_setting';
    const OBJECT_TYPE_COMPANY_SETTING = 'company_setting';

    public function getBaseDir() {
        return $this->object_type.'/'.$this->id;
    }

    //web
    public function getFullWebDir()
    {
        return $this->getBaseDir().'/'.self::FOLDER_WEB;
    }

    public function getFullWebPath() {
        return $this->getFullWebDir().'/'.$this->name;
    }

    public function getFullWebUrl()
    {
        return route('file.show.web', ['id' => $this->id]);
    }

    //mobile
    public function getFullMobileDir()
    {
        return $this->getBaseDir().'/'.self::FOLDER_MOBILE;
    }

    public function getFullMobilePath() {
        return $this->getFullMobileDir().'/'.$this->name;
    }

    public function getFullMobileUrl()
    {
        return '';
    }

    public function getFullUrl () {
        return 'full url';
    }

}
