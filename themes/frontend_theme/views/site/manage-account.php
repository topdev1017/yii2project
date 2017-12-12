<?php
frontend\assets\ManageAccountAsset::register($this);
?>
<div class="main-content">
    <?=$this->render("//general_partial/_sidebar")?>
    <div class="manage-account-content page-content">
        <section class="section-header">
            <div class="breadcrumbs">
                <ul>
                    <li>Mlazgar Associates</li>
                    <li>Username</li>
                    <li>Manage Account</li>
                </ul>
            </div>
            <h1>Manage Account</h1>
        </section>

        <h3>Your Information</h3>
        <div class="section">
            <div class="row">
                <div class="side">
                    <div class="field">
                        <label>First Name:</label>
                        <input type="text">
                    </div>
                </div>
                <div class="side">
                    <div class="field">
                        <label>Last Name:</label>
                        <input type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="side">
                    <div class="field">
                        <label>Email Address:</label>
                        <input type="email">
                    </div>
                </div>
                <div class="side">
                    <div class="field">
                        <label>Phone Number:</label>
                        <input type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="side">
                    <div class="field">
                        <label>Company Name:</label>
                        <input type="text">
                    </div>
                </div>
                <div class="side">
                    <div class="field">
                        <label>Company Website:</label>
                        <input type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="side">
                    <div class="field">
                        <label>Change Password:</label>
                        <input type="password">
                        <div class="password-strength">
                            <div class="title">
                                Password Strength: 
                                <span class="weak">Too Short</span>
                                <span class="medium">Medium</span>
                                <span class="strong">Strong</span>
                            </div>
                            <div class="strength strength_1">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="side">
                    <div class="field">
                        <label>Verify Password:</label>
                        <input type="password">
                        <div class="password-strength">
                            <div class="title">
                                Password Strength: 
                                <span class="weak">Too Short</span>
                                <span class="medium">Medium</span>
                                <span class="strong">Strong</span>
                            </div>
                            <div class="strength strength_1">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field buttons">
                <input type="submit" class="submit-btn" value="Update">
            </div>
        </div>

        <h3>Company Logo</h3>
        <div class="section">
            <div class="current-logo">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/manage-account/manage-account-default-company-logo.jpg">
            </div>
            <div class="logo-info ">
                <p>
                Below is a preview of the logo you currently have set for your company. <br>
                To update, click the "Browse" or "Choose File" button below. <br>
                Supported formats are: .JPG, .PNG, and .GIF
                </p>
                <div class="buttons">
                    <div class="field">
                        <a href="#" class="browse-btn">BROWSE</a>
                    </div>
                    <div class="field">
                        <a href="#" class="upload-btn">UPLOAD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>