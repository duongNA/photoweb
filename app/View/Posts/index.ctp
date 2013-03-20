<?php
?>
<table>

<?php foreach ($posts as $post): ?>
<tr>

  <td>
    <?php echo $this->Html->image("/files/post/image/".$post['Post']['image_dir']."/".$post['Post']['image']); ?>
  </td>

  <td>
    <ul>
      <li>
        <?php
         echo $this->Html->link($post['Post']['title'],array('controller'=>'posts','action'=>'view',$post['Post']['id']));
         ?>
      </li>

      <li>
        <?php echo $this->Html->link($post['PostOwner']['username'],array('controller'=>'users','action'=>'view',$post['PostOwner']['id'])); ?>
      </li>

      <li>
        <?php echo $post['Album']['title']; echo "||"; echo $post['Post']['created'];?>
      </li>
      <li>
        <?php echo "Viewed: ";echo $post['Post']['viewed'];
        ?>
      </li>
<!--       <li>
        <?php if($this->Session->check('Auth.User')) {
          echo $this->Form->postLink('Delete',array('action'=>'delete',$post['Post']['id']),array('message'=>'Are you sure to delete this post'));
        }?>
      </li>
      <li>
        <?php if($this->Session->check('Auth.User')) {
          echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']));
        }?>
      </li> -->
    </ul>
  </td>
</tr>

<?php endforeach ?>

</table>
<?php echo $this->Paginator->next('Next Page');?>
