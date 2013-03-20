
<h1><?php echo $post['Post']['title']; echo '<br>'; ?> </h1>
<h1><?php echo 'Viewed:'; echo $post['Post']['viewed'] ?></h1>

<?php echo $this->Html->image('/files/post/image/'.$post['Post']['image_dir'].'/'.$post['Post']['image']);
echo '<br>';
echo '<br>';
?>


<?php
echo $this->Form->create('Comment',array('controller'=>'comments','action'=>'add'));
echo $this->Form->input('Comment.comment');
echo $this->Form->input('Comment.post_id',array('type'=>'hidden','value'=>$post['Post']['id']));
// echo $this->Js->event(
//   'click',
//   $this->Js->request(
//     array('controller'=>'comments','action'=>'add'),
//     array('async'=>true,'update'=>'#comments')
//     )
//   );
echo $this->Form->end(__('Comment'));
?>


<div id="comments">
<?php
foreach ($post['Comment'] as $comment) {
  if($comment['status'] == 1){
    echo $comment['comment'];echo " ";

    if($this->Session->read('Auth.User.id') == $comment['user_id'] ){
      echo $this->Html->link('Edit',array('controller'=>'comments','action'=>'edit',$comment['id'])); echo " ";

      echo $this->Form->postLink(
                'Delete',
                array('controller'=>'comments','action' => 'delete', $comment['id']),
                array('confirm' => 'Are you sure?'));

      echo " ";
    } else {
            echo $this->Form->postLink(
                'Report',
                array('controller'=>'comments','action' => 'report', $comment['id']),
                array('confirm' => 'Are you sure?'));
    }
    echo '<br>';
    echo '<br>';
  }
}
?>
</div>

