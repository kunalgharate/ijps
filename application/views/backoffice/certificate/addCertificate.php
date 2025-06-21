<?php 
			$this->load->view(BACKOFFICE.'layout/header');
			$this->load->view(BACKOFFICE.'layout/sidemenu');
		?>
		<!--Main Content Start-->
		<style>
		    @media (max-width: 991.98px)
		    {
            .dash {
                max-width: none;
                padding: 80px 15px;
                vertical-align: middle;
            }
		    }
		    
		    
		    @media (min-width: 1399px) and (max-width: 1401px)
		    {
		         .name_css {
                    margin-top: 11vh !important;
                }
                .college_css {
                    margin-top:-18px !important;
                }
                
                /*.afillation_css {*/
                /*    font-family: Times New Roman !important;*/
                /*    margin-top: 7.5vh !important;*/
                /*    color: #dc1919 !important;*/
                /*    font-size: 16px !important;*/
                /*}*/
            
		    }
		    
		     @media (min-width: 1439px) and (max-width: 1441px)
		    {
		         .name_css {
                    margin-top: 13vh !important;
                }
		    } 
		    
		     @media (min-width: 1599px) and (max-width: 1601px)
		    {
		         .name_css {
                    margin-top: 14vh !important;
                }
		    } 
		      @media (min-width: 1679px) and (max-width: 1682px)
		    {
		        /*.title_css{*/
		        /*    margin-bottom: 2rem !important;*/
		        /*}*/
                .name_css {
                    margin-top: 11vh !important;
                }
                /*.pm-name-text {*/
                /*    font-size: 18px !important;*/
                /*}*/
                
                /*.afillation_css {*/
                /*    font-family: Times New Roman !important;*/
                /*    margin-top: 10vh !important;*/
                /*    color: #dc1919 !important;*/
                /*    font-size: 16px !important;*/
                /*}*/
                
                .college_css {
                    /*font-size: 14px !important;*/
                    margin-top:-18px !important;
                }
                
                
                /*.volume_css {*/
                /*    margin-top: 4rem !important;*/
                /*    font-size:14px !important;*/
                /*    font-weight:bold !important;*/
                /*}*/
                
                /*.pm-name-text1 {*/
                /*    margin-left: 0vh !important;*/
                /*}*/
		    } 
		    
		     @media (min-width: 1918px) and (max-width: 1922px)
		    {
		        .css_for_certify{
                  margin-top:2vh !important;
                  font-size:15px !important;
                  font-weight:600 !important;
                }
                
                .college_css{
                    font-size:14px !important;
                    margin-top: -2vh !important;
                  }
      
		        /*.title_css{*/
		        /*    margin-bottom: 2rem !important;*/
		        /*}*/
                .name_css {
                    margin-top: 11vh !important;
                    margin-left:1px !important;
                }
          /*      .pm-name-text {*/
          /*          font-size: 18px !important;*/
          /*          font-size: 19px !important;*/
          /*      }*/
                
                .afillation_css {
                    font-family: Times New Roman !important;
                    /*margin-top: 7vh !important;*/
                    color: #dc1919 !important;
                    /*font-size: 16px !important;*/
                    font-size: 18px !important;
                }
                
          /*      .college_css {*/
          /*          font-size: 13px !important;*/
          /*      }*/
                
                
                .volume_css {
                    /*margin-top: 1rem !important;*/
                    font-size:14px !important;
                    font-weight:bold !important;
                    
                        /*position: absolute !important;*/
                        /*top: 23rem !important;*/
                        /*top: 23.2rem !important;*/
                        left: 0 !important;
                        right: 0 !important;
                        bottom: 0 !important;
                }
                
          /*      .pm-name-text1 {*/
          /*          margin-left: 0vh !important;*/
          /*      }*/


		    }
		    

             @media (min-width: 1278px) and (max-width: 1282px)
            {
                .name_css {
                    margin-top: 18vh !important;
                }
                /*.college_css{*/
                /*    margin-top: -3vh !important;*/
                /*    font-size: 13px !important;*/
                /*}*/
                /*.afillation_css {*/
                /*    margin-top: 10vh !important;*/
                /*}*/
                /*.volume_css {*/
                /*    margin-top: -0.4rem !important;*/
                /*    position: absolute !important;*/
                /*        top: 23rem !important;*/
                /*        left: 0 !important;*/
                /*        right: 0 !important;*/
                /*        bottom: 0 !important;*/
                /*}*/
                /*        .pm-name-text1 {*/
                /*    margin-left: 0vh;*/
                /*}*/
            } 
            
            
            /* @media (min-width: 1364px) and (max-width: 1368px)*/
            /*{*/
                /*.name_css {*/
                /*    margin-top: 18vh !important;*/
                /*}*/
                /*.college_css{*/
                /*    margin-top: -3vh !important;*/
                /*    font-size: 13px !important;*/
                /*}*/
                /*.afillation_css {*/
                /*    margin-top: 10vh !important;*/
                /*}*/
            /*    .volume_css {*/
            /*        margin-top: -0.4rem !important;*/
            /*        position: absolute !important;*/
            /*            top: 6rem !important;*/
            /*            left: 0 !important;*/
            /*            right: 0 !important;*/
            /*            bottom: 0 !important;*/
            /*    }*/
                /*        .pm-name-text1 {*/
                /*    margin-left: 0vh;*/
                /*}*/
            /*} */

            @import url('https://fonts.googleapis.com/css?family=Open+Sans|Pinyon+Script|Rochester');

.cursive {
  font-family: 'Pinyon Script', cursive;
}

.sans {
  font-family: 'Open Sans', sans-serif;
}

.bold {
  font-weight: bold;
}

.block {
  display: block;
}

.underline {
  border-bottom: 1px solid #777;
  padding: 5px;
  margin-bottom: 15px;
}

.margin-0 {
  margin: 0;
}

.padding-0 {
  padding: 0;
}

.pm-empty-space {
  height: 40px;
  width: 100%;
}

body {
  /* padding: 20px 0; */
  /* background: #ccc; */
  overflow-x: hidden;
  
}

.pm-certificate-container {
  /* position: relative; */
  /* width: 800px; */
  height: 650px;
  /* background-color: #618597; */
  padding: 30px;
  color: #333;
  font-family: 'Open Sans', sans-serif;
  margin-top: 43px;
  /* box-shadow: 0 0 5px rgba(0, 0, 0, .5); */
  /*background: -webkit-repeating-linear-gradient(
    45deg,
    #618597,
    #618597 1px,
    #b2cad6 1px,
    #b2cad6 2px
  );
  background: repeating-linear-gradient(
    90deg,
    #618597,
    #618597 1px,
    #b2cad6 1px,
    #b2cad6 2px
  );*/
  
  .outer-border {
    width: 794px;
    height: 594px;
    position: absolute;
    left: 50%;
    margin-left: -397px;
    top: 50%;
    /* margin-top:-297px;
    border: 2px solid #fff; */
  }
  
  .inner-border {
    width: 730px;
    height: 530px;
    position: absolute;
    left: 50%;
    margin-left: -365px;
    top: 50%;
    /* margin-top:-265px; */
    /* border: 2px solid #fff; */
  }

  .pm-certificate-border {
    position: relative;
    width: 720px;
    height: 520px;
    padding: 0;
    /* border: 1px solid #E1E5F0;
    background-color: rgba(255, 255, 255, 1);
    background-image: none; */
    left: 50%;
    margin-left: -360px;
    top: 50%;
    margin-top: -260px;

    .pm-certificate-block {
      width: 650px;
      height: 200px;
      position: relative;
      left: 50%;
      margin-left: -325px;
      top: 70px;
      margin-top: 0;
    }

    .pm-certificate-header {
      margin-bottom: 10px;
    }

    .pm-certificate-title {
      position: relative;
      top: 40px;

      h2 {
        font-size: 34px !important;
      }
    }

    .pm-certificate-body {
      padding: 20px;
    }
    .pm-name-text {
        font-size: 20px;
        /*margin-left: 37vh;*/
      } 
      .pm-name-text1 {
        /* margin-left: 3vh; */
      } 

      .name_css {
        font-family: Times New Roman;
        color: darkblue;
         margin-top: 16vh; 
         margin-left:2vh !important;
      } 

      .college_css{
        font-size:14px;
        margin-top: -3vh;

      }
      .afillation_css{
        font-family: Times New Roman;
        /* margin-top: -2vh; */
        color: #dc1919;
        font-size:18px;
      }
      .volume_css{
        color:grey;
        font-size:14px;
        display: flex;
        justify-content: center;
        /* margin-top: 1rem; */
        font-weight:bold !important;
      }
    }

    .pm-earned {
      margin: 15px 0 20px;
    }
      .pm-earned-text {
        font-size: 20px;
      }
      .pm-credits-text {
        font-size: 15px;
      }
    }

    .pm-course-title {
      .pm-earned-text {
        font-size: 20px;
      }
      .pm-credits-text {
        font-size: 15px;
      }
    }

    .pm-certified {
      font-size: 12px;

      .underline {
        margin-bottom: 5px;
      }
    }

    .pm-certificate-footer {
      width: 650px;
      height: 100px;
      position: relative;
      left: 50%;
      margin-left: -325px;
      bottom: -105px;
    }
  }
}


}

.body_css{
  margin-top:20px;
}

.title_css{
    margin-bottom: 2rem !important;
}

.after_name_border{
  display: inline-block; /* Makes the border only as wide as the content */
  width: 100%; /* Set desired border width */
  border-bottom: 1px solid #000 !important;
}

.css_for_certify{
  margin-top:7vh;
  font-size:15px;
  font-weight:600;
}
.publish_css{
  font-weight:800 !important;
}
</style>

<style>
    .a4-page {
        width: 1123px;
        height: 790px;
        position: relative;
        background-image: url('certificate_new_update.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        page-break-after: always;
    }
</style>

<div id="invoice" class="body_css">
<?php if (!empty($articleResult) && is_array($articleResult)): ?>
  <?php foreach ($articleResult as $article): ?>
<div class="container d-flex flex-column container_css a4-page" style="background-image: url('<?php echo base_url(UPLOAD_LOGOS.'certificate_new_update.jpg'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card1 card-custom gutter-b card-stretch">
                    <div class="card-body p-0 position-relative overflow-hidden">
                        <div class="card-spacer1">  
                            <div class="row m-0">
                                <div class="container pm-certificate-container">
                                    <div class="outer-border"></div>
                                    <div class="inner-border"></div>
                                    <div class="pm-certificate-border col-xl-12 col-md-12 col-lg-12">
                                        <div class="row pm-certificate-header">
                                            <div class="pm-certificate-title cursive col-xl-12 col-md-12 col-lg-12 text-center">
                                                <!-- <h2>Gaurav Public Schools Certificate of Completion</h2> -->
                                            </div>
                                        </div>

                                        <div class="row pm-certificate-body">
                                          <div class="pm-certificate-block">
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                              <div class="row">
                                                <!--<div class="col-lg-2 col-md-2 col-xs-2">-->
                                                <!--</div>-->
                                                <!--<div class="col-lg-8 col-md-8 col-xs-8">-->
                                                <!--  <h1 class="text-center css_for_certify">This is to certify that</h1>-->
                                                <!--</div>-->
                                                <!--<div class="col-lg-2 col-md-2 col-xs-2">-->
                                                <!--</div>-->

                                                <div class="col-lg-2 col-md-2 col-xs-2">
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                  <h1 class="pm-name-text pm-name-text1 text-center name_css bold title_css"><?= htmlspecialchars($article['name']) ?></h1>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-xs-2">
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-xs-12" style="height: 20px;">
                                                  <h1 class="pm-name-text text-center college_css"><?= htmlspecialchars($article['affiliation']) ?></h1>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-xs-3">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-6">
                                                  <span class="after_name_border"></span>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xs-3">
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-xs-3">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-6">
                                                  <h6 class="text-center publish_css">Published a paper entitled</h6>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xs-3">
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-xs-12 d-flex flex-column align-items-center justify-content-center" style="height: 110px;">
                                                  <h1 class="pm-name-text text-center afillation_css bold">"<?= htmlspecialchars($article['titleOfPaper']) ?>"</h1>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-xs-3">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-6">
                                                  <span class="pm-name-text text-center volume_css">Volume - <?php echo substr($article['articleIDUniqueCode'], 2, 2); ?> - Issue <?php echo date("m", strtotime($article['createdDate'])); ?> - <?php echo date("Y");?></span>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xs-3">
                                                </div>

                                                <input hidden type="text" name="author_email_id" value="<?= htmlspecialchars($article['email']) ?>">
                                                <input hidden type="text" name="titleOfPaper" id="titleOfPaper" value="<?= htmlspecialchars($article['titleOfPaper']) ?>">
                                                <input hidden type="text" name="txtArticleID" id="txtArticleID" value="<?= $article['articleIDUniqueCode']; ?>">
                                                <input hidden type="text" name="manuscriptid" id="manuscriptid" value="<?= $article['manuscriptID']; ?>">
                                                
                                                <input hidden type="text" name="monthid" id="monthid" value="<?= date("m", strtotime($article['createdDate'])); ?>">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-xs-12">
                                              <div class="row">
                                                  <div class="pm-certificate-footer">
                                                      <div class="col-xs-4 pm-certified col-xs-4 text-center">
                                                          <span class="pm-credits-text block sans"></span>
                                                          <span class="pm-credits-text block sans"></span>
                                                          <span class="pm-empty-space block"></span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php else: ?>
  <div class="alert alert-warning">No certificates available for the given data.</div>
<?php endif; ?>
</div>

<div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-2 mb-4">
        <button class="btn btn-primary btn_color mt-4" id="download">Send & download pdf</button>
    </div>
    <div class="col-md-5"></div>
</div>

		<?php 
			$this->load->view(BACKOFFICE.'layout/footer');
			$this->load->view(BACKOFFICE.'layout/jsfiles');
		?>
		
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <?php 
    $insertLink = base_url()."/".BACKOFFICE.'certificate/CertificateController/savePdf';
    ?>
    
    
    
<script>
    window.onload = function () {
        document.getElementById("download").addEventListener("click", async () => {
            const invoice = document.getElementById("invoice");

            // Ensure fonts are loaded before rendering
            await document.fonts.ready;

            // Generate a random filename
            const randomNumber = Math.floor(Math.random() * 1000000);
            const filename = `certificate_${randomNumber}.pdf`;

            let scaleValue = 3; // Start with high quality
            let pdfBlob;

            const opt = {
                margin: [1, 1], // Set zero margin for precise positioning
                filename: filename,
                image: { type: 'jpeg', quality: 0.9 }, // Highest image quality
                html2canvas: { scale: scaleValue, useCORS: true }, // High scale for better resolution
                jsPDF: { unit: 'px', format: [1123, 794], orientation: 'landscape', compress: true, pdfVersion: '1.5' } // Ensure fixed size
            };

            try {
                do {
                    // Generate PDF as blob
                    pdfBlob = await html2pdf().from(invoice).set(opt).outputPdf('blob');

                    // If the PDF size is greater than 2MB, reduce scale slightly
                    if (pdfBlob.size > 2 * 1024 * 1024 && scaleValue > 2.5) {
                        scaleValue -= 0.1; // Reduce scale in small steps
                        opt.html2canvas.scale = scaleValue;
                    } else {
                        break; // Exit loop when PDF size is acceptable
                    }
                } while (pdfBlob.size > 2 * 1024 * 1024);

                // Convert PDF to Data URI for download
                const pdfDataUri = await html2pdf().from(invoice).set(opt).outputPdf('datauristring');
                const downloadLink = document.createElement('a');
                downloadLink.href = pdfDataUri;
                downloadLink.download = filename;
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);

                // Capture form data
                const articalid = $('#txtArticleID').val();
                const manuscript_document_id = $('#manuscriptid').val();
                const title_of_paper = $('#titleOfPaper').val();
                const monthid = $('#monthid').val();

                if (!articalid) {
                    alert('Article ID is missing!');
                    return;
                }

                // Upload PDF
                const formData = new FormData();
                formData.append('file', pdfBlob, filename);
                formData.append('articalid', articalid);
                formData.append('title_of_paper', title_of_paper);
                formData.append('manuscript_document_id', manuscript_document_id);
                formData.append('monthid', monthid);

                const response = await fetch('<?php echo $insertLink; ?>', {
                    method: 'POST',
                    body: formData,
                });

                const data = await response.json();
                if (data.status === 'success') {
                    alert('PDF saved successfully!');
                } else {
                    alert('Failed to save PDF: ' + data.msg);
                }

            } catch (error) {
                console.error('Error:', error);
                alert('PDF sent to email successfully.');
                window.location.href = "<?php echo site_url(BACKOFFICE.'Receviedmanuscript/index/'); ?>";
            }
        });
    };
</script>



    


    <!-- <script>
        window.onload = function () {
            document.getElementById("download")
                .addEventListener("click", () => {
                    const invoice = document.getElementById("invoice");
                    console.log(invoice);
                    console.log(window);
                    
                    // Generate a random number for the filename
                    const randomNumber = Math.floor(Math.random() * 1000000); // Generates a number between 0 and 999999
                    const filename = `myfile_${randomNumber}.pdf`;

                    var opt = {
                        margin: 1,
                        filename: filename,
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 1 },
                        jsPDF: { unit: 'cm', format: 'a4', orientation: 'landscape' }
                    };
                    html2pdf().from(invoice).set(opt).save();
                });
        }
    </script> -->

	</body>
</html>