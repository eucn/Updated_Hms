<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <script
            data-require="jquery@3.1.1"
            data-semver="3.1.1"
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <title>Guest Information</title>

        {{-- <link rel="stylesheet" href="{{ asset('css/guest_registration.css') }}"> --}}
    </head>
    <body class="bg-gray-100">
        <!-- Navbar -->

        <x-app-layout>

            <nav class="container bg-[#82e9e4] h-[50px] mx-auto rounded-b-md">
                <!-- Flex container -->
                <div class="flex items-center justify-between mx-[40px]">
                    <!-- Logo -->
                    <div class="flex flex-row justify-center items-center">
                        <img src="{{ asset('./images/BSBA.png')}}" class="h-[40px]">
                        <div class="hidden md:block">
                            <p class="text-sm">School of Business Hospitality<br>
                                and Tourism Management</p>
                        </div>
                    </div>

                    <div class="hidden md:flex space-x-6">
                        <a href="#" class="hover:text-[#E0C822] hover:font-medium">Home</a>
                        <a href="#" class="hover:text-[#E0C822] hover:font-medium">FAQs</a>
                        <a href="#" class="hover:text-[#E0C822] hover:font-medium">Contact</a>
                    </div>
                </div>
            </nav>

            <!-- Icons -->
            {{-- <div class="container">
                <div
                    class="progress-container"
                    style="position:relative; left: 400px; top: 30px;">
                    <div class="progress" id="progress"></div>
                    <div class="circle active"><img
                        src="https://r7q9b6u3.stackpathcdn.com/4.34/theme/defaultdark/img/icons/icon_nav_dates.png"
                        height="30"
                        width="25"/></div>

                    <div class="circle"><img
                        src="https://r7q9b6u3.stackpathcdn.com/4.34/theme/defaultdark/img/icons/icon_nav_info.png"
                        height="30"
                        width="25"/></div>
                    <div class="circle"><img
                        src="https://r7q9b6u3.stackpathcdn.com/4.34/theme/defaultdark/img/icons/icon_nav_rooms.png"
                        height="30"
                        width="25"/></div>
                    <div class="circle"><img
                        src="https://r7q9b6u3.stackpathcdn.com/4.34/theme/defaultdark/img/icons/icon_nav_confirmation.png"
                        height="30"
                        width="25"/></div>
                </div>
            </div> --}}
            {{-- </section> 
            <section class="room_details mx-[100px]">
                <p style="position:relative; left: 290px;">Check-in &
                </p>
                <p style="position:relative; left: 280px;">Check-out Date</p>
                <p style="position:relative; left: 480px; top: -50px;">Guest<br/></p>
                <p style="position:relative; left: 460px; top: -50px;">Information</p>
                <p style="position:relative; left: 650px; top: -100px;">Booking<br/></p>
                <p style="position:relative; left: 650px; top: -100px;">Summary</p>
                <p style="position:relative; left: 806px; top: -150px;">Payment<br/></p>
                <p style="position:relative; left: 790px; top: -150px;">Confirmation</p>
                <div class="mb-10">

                </section> --}}
            <section>
                <div class="container mx-auto pt-10 px-4 sm:px-6 lg:px-8">
                    <form method="POST" action="{{ route('save.guest.info') }}"> 
                        @csrf
                      <!-- Flex container -->
                      <div class="justify-between mx-[50px]">  
                        <div>
                              @if(session()->has('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        @endif
                      </div> 
                    
                        <!-- Logo -->
                        <div class="justify-center my-5">
                          <h2 class="text-[18px] sm:text-2xl font-semibold">Make Reservation</h2>
                          <p class="text-sm sm:text-base">Please complete the form below</p>
                        </div>
                  
                        <div class="bg-white rounded-lg border-2 shadow-md w-full pb-4">
                          <div class="border-b-2 border-gray-300 px-4 py-3">
                            <h3 class="text-lg sm:text-2xl font-semibold">Guest Information</h3>
                          </div>
                  
                          <div class="space-y-4 font-regular text-base sm:text-lg pb-10 ">
                            <div class="flex flex-col lg:flex-row justify-center">
                                <div class="mx-4 md:mx-6 py-3">
                                  <label class="" for="salutation">Salutation:</label>
                                  <select class="w-full md:w-[125px]" name="salutation" id="salutation" value="{{ old('salutation') }}" placeholder="Ms.">
                                    <option value="Ms." {{ old('salutation') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                                    <option value="Mrs." {{ old('salutation') == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                                    <option value="Mr." {{ old('salutation') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                  </select>   
                                </div>
                          
                                <div class="px-4 md:px-6 py-3">
                                  <label class="" for="fullname">Full Name:&nbsp;<span class="text-red-700 font-bold">*</span></label>
                                  <input type="text" class="w-full md:w-[400px]" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Full Name" required>  
                                </div>
                          
                                <div class="px-4 md:px-6 py-3">
                                  <label class="opacity-0" type="hidden" for="lastname">LastName</label>
                                  <input type="text" class="w-full md:w-[400px]" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>  
                                </div>
                          
                            </div>
                  
                            <div class="mx-4 sm:mx-10">                                
                              <label for="companyName">Company Name</label>
                              <input type="text" name="company_name" id="company_name" class="w-full" value="{{ old('company_name') }}" placeholder="Company Name" >                             
                            </div>
                  
                            <div class="mx-4 sm:mx-10">
                              <label for="Address">Address&nbsp;<span class="text-red-700 font-bold">*</label>
                              <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Address" class="w-full" required>                              
                            </div>
                  
                            <div class="mx-4 sm:mx-10">
                              <label for="address">Phone Number&nbsp;<span class="text-red-700 font-bold">*</label><br>
                              <input type="number"  name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="w-full sm:w-[200px]" placeholder="+63" required>                              
                              <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
                          </div>
                        </div>
                  
                        <div class="mx-auto mt-8">
                          <div class="bg-white rounded-lg shadow-md border-2 w-full ">
                            <div class="border-b-2 border-gray-300 px-4 py-3">
                              <h3 class="text- sm:text-2xl font-semibold">Payment Method</h3>
                            </div>
                  
                            <div class="mx-4 sm:mx-10 pt-5 pb-10">
                              <div class="py-2">
                                <input class="mr-2" type="radio" name="payment_method" id="cash" value="Cash" required>
                                <label for="payment_method_cash">Cash</label>
                              </div>
                              <div class="py-2">
                                <input class="mr-2" type="radio" name="payment_method" id="department_charge" value="Department Charge" required>
                                <label for="payment_method_department_charge">Department Charge</label>
                              </div>
                              <div class=" mx-[100px] bg-slate-300 border-1 border-gray-400  px-3 rounded-sm py-3" id="department_charge_options" style="display:none">
                                <div class="py-2">
                                  <input class="mr-2" type="radio" name="department" id="department_it" value="School of Information Technology">
                                  <label for="department_it">School of Information Technology</label>
                                </div>
                                <div class="py-2">
                                  <input class="mr-2" type="radio" name="department" id="department_edu" value="School of Education">
                                  <label for="department_edu">School of Education</label>
                                </div>
                                <div class="py-2">
                                  <input class="mr-2" type="radio" name="department" id="department_bhmt" value="School of Business and Hospitality and Tourism Management">
                                  <label for="department_bhmt">School of Business and Hospitality and Tourism Management</label>
                                </div>
                                <div class="py-2">
                                  <input class="mr-2" type="radio" name="department" id="department_acc" value="School of Accountancy">
                                  <label for="department_acc">School of Accountancy</label>
                                </div>
                                <div class="py-2">
                                  <input class="mr-2" type="radio" name="department" id="department_eng" value="School of Engineering and Architechture and Fine Arts">
                                  <label for="department_eng">School of Engineering and Architechture and Fine Arts</label>
                                </div>
                                <div class="py-2">
                                  <input class="mr-2" type="radio" name="department" id="department_lacj" value="School of Liberal Arts and Criminal Justice">
                                  <label for="department_lacj">School of Liberal Arts and Criminal Justice</label>
                                </div>
                              </div>
                            </div>

                            <script>
                            $(document).ready(function() {
                              // Listen for changes in the payment method radio buttons
                              $('input[name=payment_method]').change(function() {
                                if ($(this).val() === 'Cash') {
                                  // If cash is selected, unselect the department charge and hide its options
                                  $('input[name=payment_method_dept]').prop('checked', false);
                                  $('#department_charge_options').hide();
                                } else if ($(this).val() === 'Department Charge') {
                                  // If department charge is selected, unselect the cash and show its options
                                  $('input[name=payment_method_cash]').prop('checked', false);
                                  $('#department_charge_options').show();
                                }
                              });
                            });
                            </script>
                            </div>
                            <div class="flex justify-end mt-20">
                                <button  class="bg-yellow-500 hover:bg-yellow-600 text-white active:bg-yellow-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Continue</button>
                              </div> 
                            </div>
                        </div>  
                    </div>
                </form>
            </div> 
        </section>

          

            <footer class="bg-[#a2eeea] mt-[150px]">
                <div class="max-w-[1240px] mx-auto py-16 px-4 grid lg:grid-cols-4 gap-8">
                    <!-- Logo -->
                    <div
                        class="flex flex-col items-center justify-between space-y-12
                            md:flex-col md:space-y-0 md:items-start">
                        <!-- Logo -->
                        <div>
                            <img src="{{ asset('./images/logom2.png')}}" class="h-[100px]" alt="">
                        </div>
                    </div>

                    <div class="">
                        <h1 class="font-bold text-lg w-full">MICROHOTEL</h1>
                        <p class="text-sm text-gray-900">The DWCC Microhotel is a school-run hotel
                            located inside the Divine Word College of Calapan.</p>
                    </div>

                    <div class="">
                        <h1 class="font-bold text-lg">Contact Us</h1>
                        <p class="text-sm text-gray-900">Gov Infantado St, Calapan City, Oriental Mindoro</p>
                        <p class="text-sm text-gray-900">microhotel@dwcc.edu.ph</p>
                        <p class="text-sm text-gray-900">09123456789</p>
                    </div>

                    <div
                        class="flex flex-col items-center justify-between space-y-12
                        md:flex-col md:space-y-0 md:items-start">
                        <!-- Logo -->
                        <div>
                            <img src="{{ asset('./images/DWCCLOGO.png')}}" class="h-[100px]" alt="">
                        </div>
                    </div>
                </div>

                <div class="bg-[#55AFAB] flex justify-center">
                    <p class="text-sm">Copyright &copy; 2023 DWCC MicroHotel</p>
                </div>
            </footer>
        </x-app-layout>
    </body>
    <script src="{{url('js/progressbar.js')}}"></script>
    <script src="{{url('js/pm1.js')}}"></script>
</html>