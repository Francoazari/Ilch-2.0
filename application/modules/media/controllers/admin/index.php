<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Media\Controllers\Admin;

use Media\Mappers\Media as MediaMapper;

use Ilch\Date as IlchDate;

defined('ACCESS') or die('no direct access');

class Index extends \Ilch\Controller\Admin 
{
    public function init()
    {
        $this->getLayout()->addMenu
        (
            'menuMedia',
            array
            (
                array
                (
                    'name' => 'media',
                    'active' => true,
                    'icon' => 'fa fa-th-list',
                    'url' => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'index'))
                )
            )
        );
        
        $this->getLayout()->addMenuAction
        (
            array
            (
                'name' => 'menuActionAddNew',
                'icon' => 'fa fa-plus-circle',
                'url'  => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'upload'))
            )
        );
    }

    public function indexAction() 
    {
        $MediaMapper = new MediaMapper();
        
        if ($this->getRequest()->getPost('action') == 'delete' and $this->getRequest()->getPost('check_medias') > 0) {
                foreach($this->getRequest()->getPost('check_medias') as $mediaId) {
                    $MediaMapper->delImage($mediaId);
                }
                $this->addMessage('deleteSuccess');
                $this->redirect(array('action' => 'index'));
        }
        
        $MediaMapper = new MediaMapper();
        $this->getView()->set('medias', $MediaMapper->getMediaList());
        $this->getView()->set('media_ext_img', $this->getConfig()->get('media_ext_img'));
        $this->getView()->set('media_ext_file', $this->getConfig()->get('media_ext_file'));
        $this->getView()->set('media_ext_video', $this->getConfig()->get('media_ext_video'));
    }

    public function uploadAction() 
    {
        $ilchdate = new IlchDate;
        $mediaMapper = new MediaMapper();
        
        if ($this->getRequest()->isPost()) {
            
            $path = $this->getConfig()->get('media_uploadpath');
            $file = $_FILES['upl']['name'];
            $endung = pathinfo($file, PATHINFO_EXTENSION);
            $name = pathinfo($file, PATHINFO_FILENAME);
            $filename = uniqid() . $name;
            $url = $path.$filename.'.'.$endung;
            
            $model = new \Media\Models\Media();
            $model->setUrl($url);
            $model->setEnding($endung);
            $model->setName($name);
            $model->setDatetime($ilchdate->toDb());
            $mediaMapper->save($model);
            
            if(move_uploaded_file($_FILES['upl']['tmp_name'], $path.$filename.'.'.$endung)){
                
            }
        }
        return $this->getView();
    }

	public function delAction()
    {
        $MediaMapper = new MediaMapper();
        $MediaMapper->delImage($this->getRequest()->getParam('id'));
        $this->addMessage('deleteSuccess');
        $this->redirect(array('action' => 'index'));
    }
}