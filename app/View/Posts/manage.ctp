<div class="search">
<?php
  echo $this->Form->create();
  echo $this->Form->input('searchstring',array('label'=>'','placeholder'=>'Search string'));
  echo $this->Form->end('Search');
?>
</div>
<h1 class="manage-title">Post Management</h1>
<table>
  <tr>
    <th>
      Post title
    </th>
    <th>
      Owner
    </th>
    <th>
      Album
    </th>
    <th colspan="2">
      Operations
    </th>
  </tr>
    <?php foreach($posts as $post): ?>
      <tr>
        <td>
          <?php echo $this->Html->link($post['Post']['title'],array('controller'=>'posts','action'=>'view',$post['Post']['id'])) ; ?>
        </td>
        <td>
          <?php
            echo $this->Html->link($post['PostOwner']['username'],array('controller'=>'users','action'=>'view',$post['PostOwner']['id']));
          ?>
        </td>
        <td>
          <?php
            echo $this->Html->link($post['Album']['title'],array('controller'=>'albums','action'=>'view',$post['Album']['id']));
          ?>
        </td>
        <td>
          <?php echo $this->Html->link('Edit',array('controller'=>'posts','action'=>'edit',$post['Post']['id'])); ?>
        </td>
        <td>
          <?php echo $this->Form->postLink(
                'Delete',
                array('controller'=>'posts','action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
        </td>
      </tr>
    <?php endforeach ?>
</table>
<?php echo $this->Paginator->numbers();?>
