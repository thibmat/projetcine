<?php
use src\Controller\UserController;
use src\Entity\User;

$controller = new UserController();
$user = $controller->recupUserDetails();

?>
<main class='container'>
<div id="user-profile-2" class="user-profile">
    <div class="tabbable">
        <div class="tab-content no-border padding-24">
            <div id="home" class="tab-pane in active">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 center">
							<span class="profile-picture">
								<img class="editable img-responsive" alt=" Avatar" id="avatar2" style="width:215px;" src="/img<?=$user->getUserPhoto();?>">
							</span>

                        <div class="space space-4"></div>


                    </div><!-- /.col -->

                    <div class="col-xs-12 col-sm-9">


                        <div class="profile-user-info">
                            <h4 class="blue">
                                <span class="middle"><?=$user->getUserName();?></span>
                            </h4>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Email : </div>

                                <div class="profile-info-value">
                                    <span><?=$user->getUserMail();?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Inscrit depuis le : </div>

                                <div class="profile-info-value">
                                    <span><?=$user->getUserDateInscription()->format('d-m-Y');?></span>
                                </div>
                            </div>

                        </div>

                        <div class="hr hr-8 dotted"></div>


                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /#home -->
        </div>
    </div>
</div>
</main>