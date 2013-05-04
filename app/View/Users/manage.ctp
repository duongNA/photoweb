
<div class="search">
<?php
  echo $this->Form->create();
  echo $this->Form->input('searchstring',array('label'=>'','placeholder'=>'Search string'));
  echo $this->Form->end('Search');
?>
</div>
<h1 class="manage-title">User Management</h1>
<table>
  <tr>
    <th>
      User name
    </th>
    <th>
      Joined
    </th>
    <th>
      Email
    </th>
    <th>
      Role
    </th>
    <th colspan="2">
      Operations
    </th>
  </tr>
    <?php foreach($users as $user): ?>
      <tr>

        <td>
          <?php echo $this->Html->link($user['User']['username'],array('controller'=>'users','action'=>'view',$user['User']['id'])) ; ?>
        </td>
        <td>
          <?php
            echo $user['User']['created'];
          ?>
        </td>
        <td>
          <?php
            echo $user['User']['email'];
          ?>
        </td>
        <td>
          <?php 
            echo $user['User']['role'];
            ?>
        </td>
        <td>
          <?php echo $this->Html->link('Edit',array('controller'=>'users','action'=>'edit',$user['User']['id'])); ?>
        </td>
        <td>
          <?php echo $this->Form->postLink(
                'Delete',
                array('controller'=>'users','action' => 'delete', $user['User']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
        </td>
      </tr>
    <?php endforeach ?>
</table>
<?php echo $this->Paginator->numbers();?>
