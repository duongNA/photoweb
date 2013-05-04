<div class="search">
<?php
  echo $this->Form->create();
  echo $this->Form->input('searchstring',array('label'=>'','placeholder'=>'Search string'));
  echo $this->Form->end('Search');
?>
</div>

<table>
  <tr>
    <th>
      ID
    </th>
    <th>
      Comment title
    </th>
    <th>
      Owner
    </th>
    <th>
      Report
    </th>
    <th colspan="2">
      Operations
    </th>
  </tr>
    <?php foreach($comments as $comment): ?>
      <tr>

        <td>
        </td>
        <td>
          <?php echo $this->Html->link($comment['Comment']['comment'],array('controller'=>'posts','action'=>'view',$comment['Comment']['post_id'])) ; ?>
        </td>
        <td>
          <?php
            echo $this->Html->link($comment['CommentOwner']['username'],array('controller'=>'users','action'=>'view',$comment['CommentOwner']['id']));
          ?>
        </td>
        <td>
          <?php
            if($comment['Comment']['reported']==1){
              echo "On report";
            } else {
              echo "";
            }
          ?>
        </td>
        <td>
          <?php echo $this->Html->link('Edit',array('controller'=>'comments','action'=>'edit',$comment['Comment']['id'])); ?>
        </td>
        <td>
          <?php echo $this->Form->postLink(
                'Delete',
                array('controller'=>'comments','action' => 'delete', $comment['Comment']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
        </td>
      </tr>
    <?php endforeach ?>
</table>
<?php echo $this->Paginator->numbers();?>
