
<div class="row flex justify-content-center">
    <div class="col-lg-6 col-md-12 form-container">
        <div class="col-lg-12">
            <h1><?php echo $title;  ?></h1>
            <p><?php echo $vars['comments'];?></p>
        </div>
            <form id="createTasksForm" class="needs-validation" >
			<!--action="<?php //echo $vars['action'];?>"  method="post"-->
                <div class="col-lg-12 form-form">
                    <div class="form-group">
                      <input type="hidden" name="notepad" value="<?php echo isset($vars['notepad']) ? $vars['notepad'] :''   ;?>"> 
                        <input id="name_" class="form-control" name="username" type="text" placeholder="Ваше имя *" required="required" maxlength="50" data-validation-required-message="Пожалуйста, введите свое имя." data-validation-maxlength-message="Имя не должно быть больше 50 символов" autocomplete="off" value="<?php echo isset($vars['username']) ? $vars['username'] :''   ;?>">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input id="email_" class="form-control" maxlength="50" name="email" type="tel" placeholder="Ваш Email *" required email data-validation-required-message="Пожалуйста, введите свой Email." data-validation-validemail-message="" data-validation-maxlength-message="Email не должен быть больше 50 символов" autocomplete="off" value="<?php echo isset($vars['email']) ? $vars['email'] :'';?>">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <textarea id="task_name_" class="form-control" maxlength="1000" name="task_name" placeholder="Название задачи *" data-validation-required-message="Пожалуйста, введите название задачи." data-validation-maxlength-message="Название задачи не должно быть больше 1000 символов" autocomplete="off" spellcheck="false"><?php echo isset($vars['task_name']) ? $vars['task_name'] :'';?></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>    
                <div class="col-lg-12">
                    <div class="clearfix"></div>
                    <div class="justify-content-between">
                        <div id="success"></div>
                        <button id="saveTasksButton" class="btn btn-success btn-block-mobile" type="submit"><i class="fa fa-save"></i> Создать</button>
                        <a class="btn btn-warning btn-block-mobile" type="button" href="/tasks"><i class="fa fa-close"></i> Отмена</a>
                    </div>
                </div>
				<footer>
		<div class="overlay js-overlay-thank-you">
			<div class="popup js-thank-you">
				<h2>Задание успешно добавлено!</h2>
				<div class="close-popup js-close-thank-you"></div>
			</div>
		</div>
		<div class="overlay js-overlay-thank-you1">
			<div class="popup js-thank-you">
				<h2>Задание успешно обновлено!</h2>
				<div class="close-popup js-close-thank-you1"></div>
			</div>
		</div>
	</footer>
            </form>
        </div>
    </div>
</div>
