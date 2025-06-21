<?php if(!empty($coAuthorsData)){
    foreach ($coAuthorsData as $key => $value) { ?>
       <div class='card card-custom gutter-b'>
    <div class='card-body'>
        <div class='text-dark text-hover-primary font-size-h5 font-weight-bold'>Co-Author (<?php echo $key+1 ?>)</div>
        <div class='separator separator-solid my-5'></div><br>
        <div class='d-flex'>
            <div class='flex-shrink-0 mr-7'>
                <div class='symbol symbol-50 symbol-lg-120'>
                    <img alt='Pic' src='<?php echo base_url().UPLOAD_AUTHORS.$value['coAuthorPhoto']; ?>'>
                    <a href='<?php echo base_url().UPLOAD_AUTHORS.$value['coAuthorPhoto']; ?>' download><i class='fa fa-cloud-download-alt text-primary1 mt-3'></i></a>
                </div>
            </div>
            <div class='flex-grow-1'>
                <div class='d-flex align-items-center justify-content-between flex-wrap mt-2'>
                    <div class='mr-3'>
                        <a href='#' class='d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3'>
                            <?php echo $value['name']; ?>
                        </a>
                        <div class='d-flex flex-wrap my-2'>
                            <a href='#' class='text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2'>
                                <span class='svg-icon svg-icon-md svg-icon-gray-500 mr-1'>
                                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                        <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                            <rect x='0' y='0' width='24' height='24'></rect>
                                            <path d='M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z' fill='#000000'></path>
                                            <circle fill='#000000' opacity='0.3' cx='19.5' cy='17.5' r='2.5'></circle>
                                        </g>
                                    </svg>
                                </span>
                                <?php echo $value['email']; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class='d-flex align-items-center flex-wrap justify-content-between'>
                    <div class='flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5'>
                    <?php echo $value['affiliation']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php }
}else{ echo "No Co-Authors Info Found"; } ?>
