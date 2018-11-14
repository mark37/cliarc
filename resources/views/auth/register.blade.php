@extends('layouts.app')

@section('content')
<div class="container">

<!-- //TEST -->

<!-- end test -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Your password must be more than 6 characters long, contain letters and numbers, and must not contain spaces.
                                </small>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact_number" type="text" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number" required>

                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    11 digit mobile number
                                </small>

                                @if ($errors->has('contact_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="user_address" type="text" class="form-control{{ $errors->has('user_address') ? ' is-invalid' : '' }}" name="user_address" required>

                                @if ($errors->has('user_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="account_type" class="col-md-4 col-form-label text-md-right">{{ __('Account Type') }}</label>

                            <div class="form-group col">
                              <select id="account_type" name="account_type">
                                <option value="EM">Employee</option>
                                <option value="CL">Client</option>
                              </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="id_number" class="col-md-4 col-form-label text-md-right">{{ __('ID Number') }}</label>

                            <div class="col-md-6">
                              <input id="id_number" type="text" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="privacy_notice" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>

                            <div class="col-md-6">
                              <input type="checkbox" name="terms_of_service" id="terms_of_service" autofocus>
                              I agree to the
                              <a data-toggle="modal" data-target="#termsModal" style="cursor: pointer; color: blue">
                                  terms of service.
                              </a>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- PRIVACY NOTICE -->
                    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="requestModals">Privacy Notice</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h1>Privacy Policy</h1>

                                <p>Effective date: September 11, 2018</p>
                                    <p>Central Luzon Integrated Agricultural Research Center ("us", "we", or "our") operates the cliarc.com.ph website (the "Service").</p>
                                    <!-- <p>This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data. Our Privacy Policy  for Central Luzon Integrated Agricultural Research Center is managed through <a href="https://www.freeprivacypolicy.com/free-privacy-policy-generator.php">Free Privacy Policy</a>.</p> -->
                                    <p>We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, accessible from cliarc.com.ph</p>

                                <h2>Information Collection And Use</h2>
                                <p>We collect several different types of information for various purposes to provide and improve our Service to you.</p>

                                <h3>Types of Data Collected</h3>
                                <h4>Personal Data</h4>
                                <p>While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you ("Personal Data"). Personally identifiable information may include, but is not limited to:</p>
                                <ul>
                                <li>Email address</li><li>First name and last name</li><li>Cookies and Usage Data</li>
                                </ul>

                                <h4>Usage Data</h4>

                                <p>We may also collect information how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p>

                                <h4>Tracking & Cookies Data</h4>
                                <p>We use cookies and similar tracking technologies to track the activity on our Service and hold certain information.</p>
                                <p>Cookies are files with small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device. Tracking technologies also used are beacons, tags, and scripts to collect and track information and to improve and analyze our Service.</p>
                                <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>
                                <p>Examples of Cookies we use:</p>
                                <ul>
                                    <li><strong>Session Cookies.</strong> We use Session Cookies to operate our Service.</li>
                                    <li><strong>Preference Cookies.</strong> We use Preference Cookies to remember your preferences and various settings.</li>
                                    <li><strong>Security Cookies.</strong> We use Security Cookies for security purposes.</li>
                                </ul>

                                <h2>Use of Data</h2>
                                    
                                <p>Central Luzon Integrated Agricultural Research Center uses the collected data for various purposes:</p>    
                                <ul>
                                    <li>To provide and maintain the Service</li>
                                    <li>To notify you about changes to our Service</li>
                                    <li>To allow you to participate in interactive features of our Service when you choose to do so</li>
                                    <li>To provide customer care and support</li>
                                    <li>To provide analysis or valuable information so that we can improve the Service</li>
                                    <li>To monitor the usage of the Service</li>
                                    <li>To detect, prevent and address technical issues</li>
                                </ul>

                                <h2>Transfer Of Data</h2>
                                <p>Your information, including Personal Data, may be transferred to — and maintained on — computers located outside of your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from your jurisdiction.</p>
                                <p>If you are located outside Philippines and choose to provide information to us, please note that we transfer the data, including Personal Data, to Philippines and process it there.</p>
                                <p>Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</p>
                                <p>Central Luzon Integrated Agricultural Research Center will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy and no transfer of your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of your data and other personal information.</p>

                                <h2>Disclosure Of Data</h2>

                                <h3>Legal Requirements</h3>
                                <p>Central Luzon Integrated Agricultural Research Center may disclose your Personal Data in the good faith belief that such action is necessary to:</p>
                                <ul>
                                    <li>To comply with a legal obligation</li>
                                    <li>To protect and defend the rights or property of Central Luzon Integrated Agricultural Research Center</li>
                                    <li>To prevent or investigate possible wrongdoing in connection with the Service</li>
                                    <li>To protect the personal safety of users of the Service or the public</li>
                                    <li>To protect against legal liability</li>
                                </ul>

                                <h2>Security Of Data</h2>
                                <p>The security of your data is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>

                                <h2>Service Providers</h2>
                                <p>We may employ third party companies and individuals to facilitate our Service ("Service Providers"), to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.</p>
                                <p>These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>

                                <h2>Links To Other Sites</h2>
                                <p>Our Service may contain links to other sites that are not operated by us. If you click on a third party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit.</p>
                                <p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>

                                <h2>Children's Privacy</h2>
                                <p>Our Service does not address anyone under the age of 18 ("Children").</p>
                                <p>We do not knowingly collect personally identifiable information from anyone under the age of 18. If you are a parent or guardian and you are aware that your Children has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we take steps to remove that information from our servers.</p>

                                <h2>Changes To This Privacy Policy</h2>
                                <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
                                <p>We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update the "effective date" at the top of this Privacy Policy.</p>
                                <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>

                                <h2>Contact Us</h2>
                                <p>If you have any questions about this Privacy Policy, please contact us:</p>
                                <ul>
                                    <li>By visiting this page on our website: cliarc.com.ph/chat</li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>                             
                    <!-- END PRIVACY NOTICE -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
