<?php
namespace Admin\Controller;

use Application\Controller\BaseAdminController as BaseController;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

use Blog\Entity\Article;

use Admin\Form\ArticleAddForm;

class ArticleController extends BaseController{

    public function indexAction() {
        
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select('a')->from('Blog\Entity\Article', 'a')->orderBy('a.id', 'ASC');
        
        $articlesPerPage = 10; 
       
        //$query->select('a')->from('Blog\Entity\Article', 'a')->join(array('u' => 'Blog\Entity\Category'), 
                //'u.id = a.category', array(categoryName))->orderBy('a.id', 'ASC');
        
        $adapter = new DoctrineAdapter(new ORMPaginator($query));
        
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage($articlesPerPage);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
                
        return array('articles' => $paginator);
    }
    
    public function addAction(){
        
        $em = $this->getEntityManager();
        
        $form = new ArticleAddForm($em);
        $status = $message = '';
                
        $request = $this->getRequest();
        
        if($request->isPost()){
            $form->setData($request->getPost());
            
            if($form->isValid()){
                $article = new Article();
                $article->exchangeArray($form->getData());
                
                $em->persist($article);
                $em->flush();
                
                $status = 'success';
                $message = 'Категория добавлена';
            }
            else{
                $status = 'error';
                $message = 'Ошибка параметров';
            }
        }
        else{
            return ['form' => $form];
        }
        
        if($message){
            $this->flashMessenger()->setNamespace($status)->addMessage($message);
        }
        
        return $this->redirect()->toRoute('admin/article');
    }
    
    public function editAction(){
        $status = $message = '';
        $em = $this->getEntityManager();
        $form = new ArticleAddForm($em);
        
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $article = $em->find('Blog\Entity\Article', $id);
        
        if(empty($article)){
            $status = 'error';
            $message = 'Статья не найдена';
            $this->flashMessenger()->setNamespace($status)->addMessage($message);
            return $this->redirect()->toRoute('admin/article');
        }
        
        $form->bind($article);
        
        $request = $this->getRequest();
        
        if($request->isPost()){
            $data = $request->getPost();
            $form->setData($data);
            
            if($form->isValid()){
                $em->persist($article);
                $em->flush();
                
                $status = 'success';
                $message = 'Cтатья обновлена';
            }
            
            else{
                $status = 'error';
                $message = 'Ошибка параметров';
                
                foreach ($form->getInputFilter()->getInvalidInput() as $errors){
                    foreach ($errors->getMessages() as $error){
                        $message .= ' ' . $error;
                    }
                }
            }
        }
        
        else{
            return array('form' => $form, 'id' => $id);
        }
        
        if($message){
            $this->flashMessenger()->setNamespace($status)->addMessage($message);
        }
        
        return $this->redirect()->toRoute('admin/article');
        
    }
    
    public function deleteAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();
        
        $status = 'success';
        $message = 'Статья удалена.';
        
        try{
            $repository = $em->getRepository('Blog\Entity\Article');
            $article = $repository->find($id);
            $em->remove($article);
            $em->flush();
        } catch (Exception $ex) {
            $status = 'error';
            $message = 'Ошибка удаления записи: '.$ex->getMessage();
        }
        $this->flashMessenger()->setNamespace($status)->addMessage($message);
        return $this->redirect()->toRoute('admin/article');
    }
}
