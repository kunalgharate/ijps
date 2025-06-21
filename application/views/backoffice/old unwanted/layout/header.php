<!DOCTYPE html>
<html lang="en" class="businesstheme">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
		<title>Purva Paryatan</title>
		<meta name="description" content="Blinkhealth" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="" />
		
		<!-- Font Start-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!-- Font End-->
		
		<!-- Vendors Style Start -->
		<link href="<?php echo base_url('assetsbackoffice/plugins/custom/fullcalendar/fullcalendar.bundle7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
		<!-- Vendors Style End -->
		
		<!-- Global Theme Style Start -->
		<link href="<?php echo base_url('assetsbackoffice/plugins/global/plugins.bundle7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assetsbackoffice/plugins/custom/prismjs/prismjs.bundle7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assetsbackoffice/css/style.bundle7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
		<!-- Global Theme Style End -->
		
		<!-- Layout Themes Start -->
		<!--<link href="<?php echo base_url('assetsbackoffice/css/themes/layout/header/base/light7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assetsbackoffice/css/themes/layout/header/menu/light7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assetsbackoffice/css/themes/layout/brand/light7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assetsbackoffice/css/themes/layout/aside/light7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />-->
		
		<link href="<?php echo base_url('assetsbackoffice/css/themes/layout/header/base/custom.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assetsbackoffice/css/themes/layout/header/menu/custom.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assetsbackoffice/css/themes/layout/brand/custom.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assetsbackoffice/css/themes/layout/aside/custom.css'); ?>" rel="stylesheet" type="text/css" />
		<!--<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>-->
		<script src="<?php echo base_url('assetsbackoffice/\ckeditor/ckeditor.js'); ?>"></script>
		
		<!-- Layout Themes End -->
		<!--<meta name="theme-color" content="#f44336"/>-->
		<link href="<?php echo base_url('assetsbackoffice/css/custom.css'); ?>" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="<?php echo base_url('assetsbackoffice/images/favicon.png'); ?>" />
		
		<link href="<?php echo base_url('assetsbackoffice//plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css"/>
		

		<style>
		body, html {
			font-size: 13px!important;
			font-weight: 400;
			font-family: Poppins,Helvetica,sans-serif;
		}
		
		.businesstheme {
			--theme-color: #ec691f;
			--first-color: #6e7899;
			--secound-color: #6e7899;
			--third-color: #fff;
			
			--four-color: #9096b8;
			--five-color: #3699ff;
			--six-color: #637099;
			--seven-color: #ffffff;
			--eight-color: #ffffff;
			--nine-color: #ffffff;
			--ten-color: #1b1b28;
			--eleven-color: #ffffff;
			--twelve-color: #ffffff;
			--thirteen-color: #a8aabb;
			--fourteen-color: #f3f6f9;
			--fifteen-color: #484f66;
			--sixteen-color: #ffffff;
			
		}
		
	/*.btn.btn-primary {
				color: #fff;
				background-color: var(--theme-color);
				border-color: var(--theme-color);
			}*/
		
		    .btn.btn-hover-primary.focus:not(.btn-text), .btn.btn-hover-primary:focus:not(.btn-text), .btn.btn-hover-primary:hover:not(.btn-text):not(:disabled):not(.disabled) {
                color: #fff!important;
                background-color: var(--theme-color) !important;
                border-color: var(--theme-color) !important;
            }
            
            .svg-icon.svg-icon-primary svg g [fill] {
                fill: var(--theme-color) !important;
            }
            
            .btn.btn-light-primary {
                color: var(--third-color) !important;
                background-color: var(--theme-color) !important;
                border-color: transparent;
            }
		    
		    .btn.btn-light-primary:not(:disabled):not(.disabled).active, .btn.btn-light-primary:not(:disabled):not(.disabled):active:not(.btn-text), .show .btn.btn-light-primary.btn-dropdown, .show>.btn.btn-light-primary.dropdown-toggle {
                color: var(--theme-color);
                background-color: var(--third-color);
                border-color: transparent;
            }

		    .btn.btn-primary {
                color: #fff;
                background-color: var(--theme-color);
                border-color: var(--theme-color);
            }
            
            .btn.btn-primary:not(:disabled):not(.disabled).active, .btn.btn-primary:not(:disabled):not(.disabled):active:not(.btn-text), .show .btn.btn-primary.btn-dropdown, .show>.btn.btn-primary.dropdown-toggle {
                color: #fff;
                background-color: var(--five-color);
                border-color: var(--five-color);
            }
            
			::-webkit-scrollbar-thumb {
				background: var(--theme-color);
				border-radius: 0px;
				border-radius: 10px;
				border: 2px solid white;
			}
			
			::-webkit-scrollbar-track {
				border-radius: 0px;
			}
			
			::-webkit-scrollbar {
				width: 8px;
				border-radius: 10px;
				border: 2px solid white;
				
			}
			
			.datatableProfile
			{
				width:100px;
				height:auto;
			}
			
			.infoTable
				{
				    width:100%;
				}
				
				.headingSection
				{
				    background-color: #f7f7f7;
				    padding-left:10px;
				}
				
				.blink {
                    animation: blink 2s steps(1, end) infinite;
                    font-weight: bold;
                    color: red;
                    transition: 0.1s;
                }
                
                .blinkGreen {
                    animation: blink 2s steps(1, end) infinite;
                    font-weight: bold;
                    color: green;
                    transition: 0.1s;
                }
                
                @keyframes blink {
                  0% {
                    opacity: 1;
                  }
                  50% {
                    opacity: 0;
                  }
                  100% {
                    opacity: 1;
                  }
                }
		
				
				#toast-container {
					-webkit-animation: cssAnimation 5s forwards; 
					animation: cssAnimation 5s forwards;
				}
				@keyframes cssAnimation {
					0%   {opacity: 1;}
					90%  {opacity: 1;}
					100% {opacity: 0;}
				}
				@-webkit-keyframes cssAnimation {
					0%   {opacity: 1;}
					90%  {opacity: 1;}
					100% {opacity: 0;}
				}
				
				.login-bg
				{
					background-color: var(--theme-color) !important;
				}
			</style>
