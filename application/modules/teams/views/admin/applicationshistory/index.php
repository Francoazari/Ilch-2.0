<?php $teamsMapper = $this->get('teamsMapper'); ?>

<h1><?=$this->getTrans('history') ?></h1>
<?php if ($this->get('joins')): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <colgroup>
                <col class="col-lg-3" />
                <col class="col-lg-2" />
                <col class="col-lg-2" />
                <col class="col-lg-2" />
                <col class="col-lg-2" />
            </colgroup>
            <thead>
                <tr>
                    <th><?=$this->getTrans('name') ?></th>
                    <th><?=$this->getTrans('team') ?></th>
                    <th><?=$this->getTrans('dateTime') ?></th>
                    <th><?=$this->getTrans('decision') ?></th>
                    <th><?=$this->getTrans('details') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->get('joins') as $join): ?>
                    <?php $team = $teamsMapper->getTeamByGroupId($join->getTeamId()); ?>
                    <?php $date = new Ilch\Date($join->getDateCreated()); ?>
                    <tr>
                        <td><a href="<?=$this->getUrl(['action' => 'showuserhistory', 'userId' => $join->getUserId()]) ?>" title="<?=$this->getTrans('show') ?>"><?=$this->escape($join->getName()) ?></a></td>
                        <td><?=$this->escape($team->getName()) ?></td>
                        <td><?=$date->format('d.m.Y H:i', true) ?></td>
                        <td><?=($join->getDecision() == 1) ? $this->getTrans('accepted') : $this->getTrans('declined')?></td>
                        <td><a href="<?=$this->getUrl(['action' => 'show', 'id' => $join->getId()]) ?>" title="<?=$this->getTrans('show') ?>"><?=$this->getTrans('show') ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?=$this->get('pagination')->getHtml($this, ['action' => 'index']) ?>
    <div class="content_savebox">
        <form class="form-horizontal" method="POST" action="">
            <?=$this->getTokenField() ?>
            <button type="submit" name="clearHistory" class="btn btn-default"><?=$this->getTrans('clearHistory') ?></button>
        </form>
    </div>
<?php else: ?>
    <?=$this->getTrans('noApplications') ?>
<?php endif; ?>
