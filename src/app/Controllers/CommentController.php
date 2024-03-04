<?php
namespace App\Controllers;

use App\Models\CommentModel;


class CommentController extends BaseController
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel;
        
    }
    // получение страницы index()
    // получение комментариев getComments
    // добавление комментария addComment(одинаково для обычного и вложенного)
    // получение вложенных комментариев getReplyComments
    // удаление комментария deleteComment
    // Нужно еще фильтрацию/сортировка по id и create_at

    public function index()
    {
        $data = [
            'page' => isset($_GET['page']) ? $_GET['page'] : 1,
            'perPage' => 3,
            'comments' => $this->commentModel->paginate(3),
            'total' => $this->commentModel->where('reply_id', null)->countAllResults(),
            'pager' => $this->commentModel->pager
        ];

        return view("Comment/comments", $data);
    }

    public function addComment()
    {
        $data = $this->request->getPost();
        $dataComment = [
            'email' => esc($data['email']) ?? null,
            'text' => esc($data['comment']) ?? null,
            'created_at' => esc($data['created_at']) ?? null,
            'reply_id' =>isset($data['reply_id']) ? esc($data['reply_id']) : null
        ];

        try {
            $this->commentModel->insert($dataComment);
            return redirect()
                ->to('/');
        } catch (\Exception $e) {
            return $this->response->setJSON(['errors'=>$this->commentModel->errors()]);
        }
    }


    public function getComments()
    {

        $sortBy = $_GET['sortBy'] ?? 'created_at';
        $sortDirection = $_GET['sortDirection'] ?? 'DESC';

        try {
            $data = $this->commentModel->orderBy("$sortBy", "$sortDirection")->where('reply_id', null)->paginate(3);
            
            return $this->response->setJSON(['status'=>'OK', 'data'=>$data]);

        } catch (\Exception $e) {
            return $this->response->setJSON(['errors'=>$this->commentModel->errors()]);
        }
    }

    public function deleteComment($id)
    {
        try {
            $this->commentModel->find($id);
            $this->commentModel->delete($id);

            return $this->response->setJSON(['status'=>'OK']);

        } catch (\Exception $e) {
            return $this->response->setJSON(['errors'=>$this->commentModel->errors()]);
        }
    }

    /*
    public function getCommentsReply($id)
    {
        try {
            $data = [
                'page' => isset($_GET['page']) ? $_GET['page'] : 1,
                'perPage' => 3,
                'comments' => $this->commentModel->orderBy('id', 'DESC')->where('reply_id', null)->paginate(3),
                'total' => $this->commentModel->countAll(),
                'pager' => $this->commentModel->pager
            ];
            
            return $this->response->setJSON(['status'=>'OK', 'data'=>$data]);

        } catch (\Exception $e) {
            return $this->response->setJSON(['errors'=>$this->commentModel->errors()]);
        }
    }
    */
}