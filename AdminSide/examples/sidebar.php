<html>
<div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          BookMyBai
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <?php 
            if(isset($admin))
            {
              ?>
              <li class="nav-item active  ">
              <?php
            }
            else
            {
              ?>
              <li class="nav-item ">
          <?php
            }
          ?>
          
          <!-- <li class="nav-item active  "> -->
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <?php 
            if(isset($user))
            {
              ?>
              <li class="nav-item active  ">
              <?php
            }
            else
            {
              ?>
              <li class="nav-item ">
          <?php
            }
          ?>
          
            <a class="nav-link" href="<?php echo base_url();?>index.php/HouseMaidController/user_view">
              <i class="material-icons">content_paste</i>
              <p>User Profile</p>
            </a>
          </li> 
          <?php 
            if(isset($set))
            {
              ?>
              <li class="nav-item active  ">
              <?php
            }
            else
            {
              ?>
              <li class="nav-item ">
          <?php
            }
          ?>
          
            <a class="nav-link" href="<?php echo base_url();?>index.php/HouseMaidController/table_view">
              <i class="material-icons">person</i>
              <p>Customers</p>
            </a>
          </li>
           <?php 
            if(isset($helper))
            {
              ?>
              <li class="nav-item active  ">
              <?php
            }
            else
            {
              ?>
              <li class="nav-item ">
          <?php
            }
          ?>
            <a class="nav-link" href="<?php echo base_url();?>index.php/HouseMaidController/helper_view">
              <i class="material-icons">library_books</i>
              <p>Helpers</p>
            </a>
          </li>
          <?php 
            if(isset($apt))
            {
              ?>
              <li class="nav-item active  ">
              <?php
            }
            else
            {
              ?>
              <li class="nav-item ">
          <?php
            }
          ?>
            <a class="nav-link" href="<?php echo base_url();?>index.php/HouseMaidController/area_view">
              <i class="material-icons">bubble_chart</i>
              <p>Area</p>
            </a>
          </li>
           <?php 
            if(isset($service))
            {
              ?>
              <li class="nav-item active  ">
              <?php
            }
            else
            {
              ?>
              <li class="nav-item ">
          <?php
            }
          ?>
            <a class="nav-link" href="<?php echo base_url();?>index.php/HouseMaidController/service_view">
              <i class="material-icons">location_ons</i>
              <p>Services</p>
            </a>
          </li>
          <?php 
            if(isset($time))
            {
              ?>
              <li class="nav-item active  ">
              <?php
            }
            else
            {
              ?>
              <li class="nav-item ">
          <?php
            }
          ?>
            <a class="nav-link" href="<?php echo base_url();?>index.php/HouseMaidController/time_view">
              <i class="material-icons">notifications</i>
              <p>Time Slot</p>
            </a>
          </li>
           <?php 
            if(isset($lang))
            {
              ?>
              <li class="nav-item active  ">
              <?php
            }
            else
            {
              ?>
              <li class="nav-item ">
          <?php
            }
          ?>
            <a class="nav-link" href="<?php echo base_url();?>index.php/HouseMaidController/lang_view">
              <i class="material-icons">language</i>
              <p>Languages</p>
            </a>
          </li>
           <?php 
            if(isset($city))
            {
              ?>
              <li class="nav-item active  ">
              <?php
            }
            else
            {
              ?>
              <li class="nav-item ">
          <?php
            }
          ?>
            <a class="nav-link" href="<?php echo base_url();?>index.php/HouseMaidController/city_view">
              <i class="material-icons">Cities</i>
              <p>Cities</p>
            </a>
        </ul>
      </div>
      </html>