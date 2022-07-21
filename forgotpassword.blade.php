<div>
    <x-home.nav/>
    {{-- forgort password page --}}
    <div class="container mt-5 mb-5">
        <h4 class="text-center text-success">Forgot Password</h4>
        <p class="text-center text-success"> " Enter your registered email to reset your password"</p>
        <div class="d-flex justify-content-center">
           
            <div class="card" style="width:33%;">
              
                <div class="card-body">
                 
                    <div class="container mt-5" style="max-width: 550px">

                        <div class="alert alert-danger" id="error" style="display: none;"></div>
                
                        <h3>Add Phone Number</h3>
                
                        <div class="alert alert-success" id="successAuth" style="display: none;"></div>
                
                        <form>
                            <label>Phone Number:</label>
                
                            <input type="text" id="number" class="form-control" placeholder="+91 ********">
                
                            <div id="recaptcha-container"></div>
                
                            <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">Send OTP</button>
                        </form>
                
                
                        <div class="mb-5 mt-5">
                            <h3>Add verification code</h3>
                
                            <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
                
                            <form>
                                <input type="text" id="verification" class="form-control" placeholder="Verification code">
                                <button type="button" class="btn btn-danger mt-3" onclick="verify()">Verify code</button>
                            </form>
                        </div>
                    </div>




                    </div>
                  </div>
            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    
        <script>
            $(document).ready(function() {
              toastr.options = {
                          'closeButton': true,
                          'debug': false,
                          'newestOnTop': false,
                          'progressBar': true,
                          'positionClass': 'toast-top-right',
                          'preventDuplicates': false,
                          'showDuration': '1000',
                          'hideDuration': '1000',
                          'timeOut': '5000',
                          'extendedTimeOut': '1000',
                          'showEasing': 'swing',
                          'hideEasing': 'linear',
                          'showMethod': 'fadeIn',
                          'hideMethod': 'fadeOut',
                      }
                    // toastr.success("ranjan");
                toastr.options.timeOut =8000;
                @if (Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif(Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @elseif(Session::has('info'))
                    toastr.info('{{ Session::get('info') }}');
                @endif
               
            });
          
          </script>
        <script>
            var firebaseConfig = {
      apiKey: "AIzaSyClbqM8c7-Hb4aEgh5-up_hIpEbsGI9Yiw",
      authDomain: "otpverify-df33a.firebaseapp.com",
      databaseURL: "https://otpverify-df33a.firebaseio.com",
      projectId: "otpverify-df33a",
      storageBucket: "otpverify-df33a.appspot.com",
      messagingSenderId: "681337554148",
      appId: "1:681337554148:web:aced37a2558fd4461a98f1"
            };
            firebase.initializeApp(firebaseConfig);
        </script>
        <script type="text/javascript">
            window.onload = function () {
                render();
            };
    
            function render() {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
                recaptchaVerifier.render();
            }
    
            function sendOTP() {
                var number = $("#number").val();
               
                $.ajax({
       
          url:'{{route("resetphone")}}',
          type:"POST",
       
          dataType:"json",
            data:{
                "_token": "{{ csrf_token() }}",
               
                phone:number
               
            },
            success:function(res){
        //    console.log(res);
           if(res.success){
            
            toastr.success("otp has been sent successfully..");  
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    // console.log(coderesult);
                    $("#successAuth").text("Message sent");
                    $("#successAuth").show();
                }).catch(function (error) {
                    $("#error").text(error.message);
                    $("#error").show();
                });



         
           }
          
           else if(res.error){
               toastr.info('phone is not found...')
           }
        }
     });


          
            }
    
            function verify() {
                var code = $("#verification").val();
                coderesult.confirm(code).then(function (result) {
                    var user = result.user;
                    // console.log(user);
                    $("#successOtpAuth").text("Auth is successful");
                    
                    $("#successOtpAuth").show();
                    window.location.href = "http://127.0.0.1:8000/resetpass";
                }).catch(function (error) {
                    $("#error").text(error.message);
                    $("#error").show();
                });
            }
        </script>
    
    <x-home.footer/>

</div>
