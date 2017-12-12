<?php
frontend\assets\LightingControlsAsset::register($this);

use backend\models\Manufactures;
?>
<div class="main-content lighting-controls">
    <h1>Lighting Controls</h1>
    <p>With today's advancements in technology, lighting control options have reached new heights. No matter how large or small your application, Mlazgar has lighting control solutions to match your simplest or most complex challenges. You will be amazed at the latest options in lighting control for the future.</p>

    <ul class="lighting-controls-list">
        <li>
            <div class="header">
                <h3>Architectural Control</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/arhitectural-control.jpg">
            </div>
            <p>The Lehigh and Acclaim systems provide adaptable, scalable solutions that can fully integrate with lighting, audiovisual, window treatments and sensors for maximum flexibility and energy savings. These solutions can be easily designed, installed and reconfigured to meet the changing needs of your space.</p>
            <!--<p>These systems provide flexible, scalable systems that can fully integrate lighting, A/V, window treatments and sensors for maximum flexibility and energy savings. These solutions can be easily designed, installed and reconfigured to meet the changing needs of your space.</p>-->
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Lehigh")?> <?=Manufactures::linkManufacture("Acclaim Lighting")?> </h4>
        </li>
        <li>
            <div class="header">
                <h3>Commercial Building Controls</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/commercial-building-controls.jpg">
            </div>
            <p>Conserve energy, reduce operating costs, and improve lighting quality with relay panels, wireless devices, or addressable lighting controls systems by Douglas, Hubbell, or Kanepi. Lighting control systems can be tailored to meet the needs of offices, schools, manufacturers, warehouses, retail spaces and sports facilities. </p>
            <!--<p>Conserve energy, reduce operating cost, and improve lighting quality with relay panels, wireless devices or addressable lighting controls systems. Lighting control systems can be tailored to meet the needs of offices, schools, manufacturers, warehouses, retail spaces and sports facilities.</p>-->
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Douglas")?> <?=Manufactures::linkManufacture("Hubbell Building Automation")?> <?=Manufactures::linkManufacture("Kanepi")?></h4>
        </li>
        <li>
            <div class="header">
                <h3>Single Room Solutions</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/single-room-solutions.jpg">
            </div>
            <p>Room based systems simplify the design process, ensure code compliance, provide easy installation and commissioning. A cost effective way to bring basic lighting control to your projects.</p>
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Douglas")?> <?=Manufactures::linkManufacture("Hubbell Building Automation")?></h4>
        </li>
        
        <li>
            <div class="header">
                <h3>Daylight control</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/daylight-controls.jpg">
            </div>
            <p>Integrating daylighting control with high-efficiency lighting control systems will save money, help compliance with energy codes, and create more productive and comfortable learning and working environments.</p>
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Douglas")?> <?=Manufactures::linkManufacture("Hubbell Building Automation")?></h4>
        </li>
        
        <li>
            <div class="header">
                <h3>Exterior control</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/exterior-control.jpg">
            </div>
            <p>Facility managers can automate and manage lighting remotely via simple interfaces, resulting in optimized lighting quality, increased energy savings, simplified maintenance, and lower operating costs. Connecting outdoor lighting to the IT infrastructure is one of the most effective ways to maximize security, meet the latest code requirements.</p>
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Hubbell Building Automation")?> <?=Manufactures::linkManufacture("Beacon")?> <?=Manufactures::linkManufacture("LED Roadway Lighting")?> <?=Manufactures::linkManufacture("GigaTera")?></h4>
        </li>
        
        <li>
            <div class="header">
                <h3>Entertainment and Theatrical systems</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/entertainment-and-theatrical-systems.jpg">
            </div>
            
            <p>High performance controls for entertainment and architectural lighting demands. Control solutions for the challenging and unique lighting effects of cultural venues, luxury hotels, theme parks, cruise ships, TV-studio sets and clubs.</p>
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Acclaim")?> <?=Manufactures::linkManufacture("Elation")?> <?=Manufactures::linkManufacture("Lehigh")?></h4>
        </li>
        
        <li>
            <div class="header">
                <h3>Sensors</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/sensors.jpg">
            </div>
            
            <p>Daylighting and occupancy sensors maximize energy savings by ensuring that lights are turned off or to a lower level when spaces are unoccupied or adequate daylight exists.</p>
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Douglas")?> <?=Manufactures::linkManufacture("Hubbell Building Automation")?></h4>
        </li>
        
        <li>
            <div class="header">
                <h3>Patient room control</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/patient-room-control.jpg">
            </div>
            
            <p>Controls make it simple to operate each function of single or multiple light fixtures with one simple to use keypad. Keypads can control the reading, ambient, examination and spot lights. With sanitation management in mind there is Mylar overlay on each keypad for ease of cleaning.</p>
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Amico")?></h4>
        </li>
        
        <li>
            <div class="header">
                <h3>Security and surveillance</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/security-and-surveillance.jpg">
            </div>
            
            <p>Flexible wired and wireless solutions for integrating energy efficient lighting, audio, digital signage, security surveillance and more into your city, campus or sporting venue.</p>
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Sternberg")?> <?=Manufactures::linkManufacture("Spaulding")?> <?=Manufactures::linkManufacture("GigaTera")?></h4>
        </li>
        
        <li>
            <div class="header">
                <h3>Emergency lighting bypass</h3>
                <a href="javascript:void(0)" class="scroll-top scroll-top-icon" data-target=".lighting-controls"></a>
                <div class="spacer"></div>
            </div>
            <div class="image">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/lighting-controls/emergency-lighting-bypass.jpg">
            </div>
            
            <p>UL 924 listed relays for emergency lighting.</p>
            <h3>Manufacturers</h3>
            <h4><?=Manufactures::linkManufacture("Hubbell Building Automation")?></h4>
        </li>
    </ul>
</div>