<div class="row flex justify-content-center">
    <div class="col-lg-6 col-md-12 form-container">
        <div class="col-lg-12">
            <h1>Вход</h1>
            <p>Пожалуйста, заполните следующие поля для входа в админку:</p>
        </div>    
            <form id="loginFormTasks" class="needs-validation" action="login" method="post" novalidate>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input class="form-control" name="login" type="text" placeholder="Ваш логин *" required="required" data-validation-required-message="Пожалуйста, введите свой логин." autocomplete="off">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Ваш пароль *" required data-validation-required-message="Пожалуйста, введите свой пароль." autocomplete="off">
                        <p class="help-block text-danger"></p>
                    </div>
                <div class="col-lg-12">
                    <?php if($title): ?>
                        <div>
                        <p class="help-block text-danger"> Неверные логин или пароль!</p>
                        </div>                     
                    <?php endif;?>
                    <div class="clearfix"></div>
                    <div class="flex justify-content-between">
                        <div id="success"></div>
                        <button id="loginButton" class="btn btn-success btn-block-mobile" type="submit"><i class="fa fa-paper-plane"></i> Войти</button>
                        <a class="btn btn-warning btn-block-mobile" type="button" href="<?php echo $_SESSION['referer'];?>"><i class="fa fa-close"></i> Отмена</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
