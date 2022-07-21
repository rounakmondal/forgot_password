<div>
    <x-home.nav/>
    {{-- forgort password page --}}
    <div class="container mt-5 mb-5">
        <h4 class="text-center text-success">Forgot Password</h4>
        <p class="text-center text-success"> " Enter password and confirm the password"</p>
        <div class="d-flex justify-content-center">
           
            <div class="card" style="width:33%;">
              
                <div class="card-body">
                 
                  
                             
                                <form action ="updatepassword" method ="POST">
                                    @csrf
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Password</label>
                                      <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="password" name="pass">
                                      
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Confirm Password</label>
                                      <input type="password" class="form-control" id="exampleInputPassword1" name="cpass" placeholder="Password">
                                    </div>
                                   
                                    <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                </div>
                                  </form>
            
            
            
            
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
       

          
        
    
    <x-home.footer/>

</div>
