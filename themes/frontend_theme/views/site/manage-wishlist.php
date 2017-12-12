<?php
frontend\assets\ManageWishlistAsset::register($this);
?>
<div class="main-content">
    <?=$this->render("//general_partial/_sidebar")?>
    <div class="manage-wishlist-content page-content">
        <section class="section-header">
            <div class="breadcrumbs">
                <ul>
                    <li>Mlazgar Associates</li>
                    <li>Username</li>
                    <li>Manage Wishlist</li>
                </ul>
            </div>
            <h1>Welcome Name</h1>
        </section>

        <h3 class="section-title">Create New Wishlist</h3>
        <div class="section-create-wishlist">
            <input type="text" placeholder="Enter Wishlist Name">
            <input type="submit" class="create-wishlist" value="Create Wishlist">
        </div>
        
        <h3 class="section-title">Your Wishlist</h3>
        <div class="section-your-wishlist">
            <ul>
                <li>
                    <h3>First Wishlist Name</h3>
                    <div class="buttons">
                        <a href="#">View</a>
                        <a href="#">Delete</a>
                    </div>
                </li>
                <li>
                    <h3>Second Wishlist Name</h3>
                    <div class="buttons">
                        <a href="#">View</a>
                        <a href="#">Delete</a>
                    </div>
                </li>
                <li>
                    <h3>Third Wishlist Name</h3>
                    <div class="buttons">
                        <a href="#">View</a>
                        <a href="#">Delete</a>
                    </div>
                </li>
                <li>
                    <h3>Fourth Wishlist Name</h3>
                    <div class="buttons">
                        <a href="#">View</a>
                        <a href="#">Delete</a>
                    </div>
                </li>        
            </ul>
        </div>
        
    </div>
</div>