<?php 

namespace Phpmvc\Comment; 

/** 
 * To attach comments-flow to a page or some content. 
 * 
 */ 
class CommentController implements \Anax\DI\IInjectionAware 
{ 
    use \Anax\DI\TInjectable; 



    /** 
     * View all comments. 
     * 
     * @return void 
     */ 
    public function viewAction($key=null,$redirect=null) 
    { 
        $comments = new \Phpmvc\Comment\CommentsInSession($key); 
        $comments->setDI($this->di); 
        $all = $comments->findAll(); 

        $this->views->add('comment/comments', [ 
            'comments' => $all, 
            'key'       => $key, 
            'redirect' => $redirect, 
        ]); 
    } 



    /** 
     * Add a comment. 
     * 
     * @return void 
     */ 
    public function addAction() 
    { 
        $isPosted = $this->request->getPost('doCreate'); 
         
        if (!$isPosted) { 
            $this->response->redirect($this->request->getPost('redirect')); 
        } 

        $comment = [ 
            'content'   => $this->request->getPost('content'), 
            'name'      => $this->request->getPost('name'), 
            'web'       => $this->request->getPost('web'), 
            'mail'      => $this->request->getPost('mail'), 
            'timestamp' => time(), 
            'ip'        => $this->request->getServer('REMOTE_ADDR'), 
        ]; 

        $comments = new \Phpmvc\Comment\CommentsInSession($this->request->getPost('key')); 
        $comments->setDI($this->di); 

        $comments->add($comment); 

        $this->response->redirect($this->request->getPost('redirect')); 
    } 
     
    /** 
     * removes comment at specifik id 
     * $param int $id of the comment to be removed. 
     * @return void 
     */ 
    public function deleteAction($id) { 
        $isPosted = $this->request->getPost('doRemove'); 
        if (!$isPosted) { 
            $this->response->redirect($this->request->getPost('redirect')); 
        } 
       $comments = new \Phpmvc\Comment\CommentsInSession($this->request->getPost('key')); 
        $comments->setDI($this->di); 
        $comments->delete($id); 
        $this->response->redirect($this->request->getPost('redirect')); 
    } 
     
    public function saveAction($id) { 
        $isPosted = $this->request->getPost('doSave'); 
         
        if (!$isPosted) { 
            $this->response->redirect($this->request->getPost('redirect')); 
        } 

        $comment = [ 
            'content'   => $this->request->getPost('content'), 
            'name'      => $this->request->getPost('name'), 
            'web'       => $this->request->getPost('web'), 
            'mail'      => $this->request->getPost('mail'), 
            'timestamp' => time(), 
            'ip'        => $this->request->getServer('REMOTE_ADDR'), 
        ]; 

        $comments = new \Phpmvc\Comment\CommentsInSession($this->request->getPost('key')); 
        $comments->setDI($this->di); 
        $comments->save($comment,$id); 
        $this->response->redirect($this->request->getPost('redirect')); 
    } 
     
    public function editAction($id) { 
        $isPosted = $this->request->getPost('doEdit'); 
        if (!$isPosted) { 
            $this->response->redirect($this->request->getPost('redirect')); 
        } 
         
        $comments = new \Phpmvc\Comment\CommentsInSession($this->request->getPost('key')); 
        $comments->setDI($this->di); 
        $comment = $comments->find($id); 
         
        $this->theme->setTitle('Editera Kommentar'); 
         
        $this->views->add('comment/edit',  [ 
            'mail'      => $comment['mail'], 
            'web'       => $comment['web'], 
            'name'      => $comment['name'], 
            'content'   => $comment['content'], 
            'id'    => $id, 
            'redirect' => $this->request->getPost('redirect'), 
            'key'       => $this->request->getPost('key'), 
        ]); 
    } 


    /** 
     * Remove all comments. 
     * 
     * @return void 
     */ 
    public function removeAllAction() 
    { 
        $isPosted = $this->request->getPost('doRemoveAll'); 
         
        if (!$isPosted) { 
            $this->response->redirect($this->request->getPost('redirect')); 
        } 

        $comments = new \Phpmvc\Comment\CommentsInSession($this->request->getPost('key')); 
        $comments->setDI($this->di); 

        $comments->deleteAll(); 

        $this->response->redirect($this->request->getPost('redirect')); 
    } 
} 