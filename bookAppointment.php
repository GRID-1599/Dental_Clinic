<?php
include_once "classes/serviceCategory.class.php";
include_once "classes/service.class.php";
$appServiceCat_obj = new ServiceCategory();
$appService_obj = new Service();
$serviceCategoryIdAndName_Array = $appServiceCat_obj->getServicesCategory_Name();
?>
<div class="appointmentInputs">
    <div class="serviceInputs ">
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3>Please choose atleast one service: </h3>
                    </div>
                    <div class="col-4">
                        <input type="text" placeholder="Search a service" id="searchService">
                        <button><i class="fas fa-search"></i></button>

                    </div>
                </div>
            </div>
            <div class="container ">
                <div class="row services-box">
                    <div class="col-5  appServiceCat-box">
                        <h5>Service Categories</h5>
                        <button id="C999" class="appSrvCatgy catSelected">ALL</button>
                        <?php
                        $serviceCategories = $appServiceCat_obj->getAllServicesCategory();

                        foreach ($serviceCategories as $entry) {
                            $serviceCategory_Name = $entry["Name"];
                            $serviceCategory_ID = $entry["ServiceCategory_Id"];

                            echo "<button id=" . $serviceCategory_ID . " class='appSrvCatgy '>" . $serviceCategory_Name . "</button>";
                        }
                        ?>
                    </div>
                    <div class="col-7  appService-box">
                        <table class="table-appService ">
                            <tbody>
                                <?php
                                $services = $appService_obj->getAllServices();

                                while ($row = $services->fetch()) {
                                    $serviceName = $row["Name"];
                                    // $serviceDescription = $row["Description"];
                                    $serviceStarting_Price = $row["Starting_Price"];
                                    // $ImgFilename = $row["ImgFilename"];
                                    $serviceService_ID = $row["Service_ID"];

                                    $serviceServiceCategory_ID = $serviceCategoryIdAndName_Array[$row["ServiceCategory_ID"]];

                                    $isSelected = "";
                                    if (isset($_GET["serviceID"]) && $_GET["serviceID"] == $serviceService_ID) {
                                        $isSelected = "serviceSelected";
                                    }
                                    // $imagePath = "resources/Dental_Pics/logov2.png";

                                    echo <<<SERVICEROW
                                    <tr id="$serviceService_ID" class="serviceRow $isSelected">
                                    <td colspan="2" class="serviceName">$serviceName</td>
                                    <td class="servicePrice">$serviceStarting_Price</td>
                                    </tr>
                                SERVICEROW;
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom border">
            <h3>Select apppointment date & time: </h3>
            <div class="container h-100   wrapper">
                <div class="row">
                    <div class="col appCalendar ">
                        <div class="container-fluid ">
                            <div class="container">
                                <div class="row w-100 calendar-select">
                                    <div class="col-auto">
                                        <label class="lead mr-2 ml-3" for="year">Select year: </label><select class="form-control jumpDate" name="year" id="year">
                                            <?php
                                            $todayYear = date("Y");
                                            for ($yr = $todayYear; $yr <= ($todayYear + 5); $yr++) {
                                                echo "<option value=" . $yr . ">" . $yr . "</option>";
                                            }
                                            ?>
                                            <!-- <option value=2010>2010</option> -->
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <label class="lead mr-2 ml-2" for="month">Jump To: </label>
                                        <select class="form-control col-sm-3 jumpDate" name="month" id="month">
                                            <option value=0>January</option>
                                            <option value=1>Febuary</option>
                                            <option value=2>March</option>
                                            <option value=3>April</option>
                                            <option value=4>May</option>
                                            <option value=5>June</option>
                                            <option value=6>July</option>
                                            <option value=7>August</option>
                                            <option value=8>September</option>
                                            <option value=9>October</option>
                                            <option value=10>November</option>
                                            <option value=11>December</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <br>
                                        <button type="button" id="btnTodayDate">Go Today</button>
                                    </div>
                                </div>


                            </div>

                            <div class="card">
                                <div class="tableHeader">
                                    <button class="btn-light lead " id="preMonth" type="button"><i class="fas fa-caret-left"></i></button>

                                    <h3 class="card-header" id="todayMonthDate"></h3>

                                    <button class="btn-light lead " id="nextMonth" type="button"><i class="fas fa-caret-right"></i></button>
                                </div>
                                <table class="table  table-borderless" id="calendar">
                                    <thead>
                                        <tr>
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                        </tr>
                                    </thead>
                                    <tbody id="calendarBody">
                                    </tbody>
                                </table>

                                <br />
                                <!-- <form class="form-inline">
                                    <button class="btn-outline-primary lead" id="pre" type="button" onclick="preMonth()"><i class="fas fa-caret-left"></i> Previous</button>
                                    <button class="btn-outline-primary lead " id="nex" type="button" onclick="nexMonth()">Next <i class="fas fa-caret-right"></i></button>
                                </form> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-3  appTimePicker h-100 unShow">
                        <p class="selectedDAte"></p>
                        Available Time/s
                        <div class="container">
                            <div class="row w-75">
                                <button class="timeRange" value="9">9:00 am</button>
                            </div>
                            <div class="row w-75">
                                <button class="timeRange" value="10">10:00 am</button>
                            </div>
                            <div class="row w-75">
                                <button class="timeRange" value="11">11:00 am</button>
                            </div>
                            <div class="row w-75">
                                <button class="timeRange" value="1">1:00 pm</button>
                            </div>
                            <div class="row w-75">
                                <button class="timeRange" value="2">2:00 pm</button>
                            </div>
                            <div class="row w-75">
                                <button class="timeRange" value="3">3:00 pm</button>
                            </div>
                            <div class="row w-75">
                                <button class="timeRange" value="4">4:00 pm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container patientForm unShow">
        <!-- Dental History -->
        <div class="row serviceFormCategory  ">
            <br><br>
            <h3>Dental History</h3>
            <div class="container questionCategoryWrapper">
                <div class="input-group flex-nowrap ">
                    <span class="input-group-text">Last Dental Visit: </span>
                    <input type="date" class="form-control ">
                </div>
                <div class="input-group flex-nowrap question">
                    <span class="input-group-text">Purpose of last Dental Visit</span>
                    <input type="text" class="form-control ">
                </div>
            </div>
            <!-- Dental History end -->
        </div>
        <!-- Medical History -->
        <div class="row serviceFormCategory  ">
            <h3>Medical History</h3>
            <div class="container questionCategoryWrapper">
                <!-- last medical check up -->
                <div class="input-group flex-nowrap question">
                    <span class="input-group-text">When was your last medical check up ? </span>
                    <input type="date" class="form-control ">
                </div>
                <!-- medical treatment -->
                <div class="input-group flex-nowrap question">
                    <span class="input-group-text">Are you under any medical treatment right now ?</span>
                    <div class="form-control no-border">
                        <input type="radio" id="rdTreatmentYes" name="treatment" value="yes">
                        <label for="rdTreatmentYes">Yes</label>
                        <input type="radio" id="rdTreatmentNo" name="treatment" value="no">
                        <label for="rdTreatmentNo">No</label>
                    </div>
                </div>
                <div class="container ifYes unShow" id="treatment">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text">If yes, what is the condition being treated?</span>
                        <input type="text" class="form-control ">
                    </div>
                </div>
                <!-- Medications -->
                <div class="input-group flex-nowrap question">
                    <span class="input-group-text">Are you taking any medications ?</span>
                    <div class="form-control no-border">
                        <input type="radio" id="rdMedicationsYes" name="medications" value="yes">
                        <label for="rdMedicationsYes">Yes</label>
                        <input type="radio" id="rdMedicationsNo" name="medications" value="no">
                        <label for="rdMedicationsNo">No</label>
                    </div>
                </div>
                <div class="container ifYes unShow" id="medications">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text">If yes, please specify.</span>
                        <input type="text" class="form-control ">
                    </div>
                </div>

                <!-- Hospitalized -->
                <div class="input-group flex-nowrap question">
                    <span class="input-group-text">Have you been ever hospitalized ?</span>
                    <div class="form-control no-border">
                        <input type="radio" id="rdHospitalizedYes" name="hospitalized" value="yes" >
                        <label for="rdHospitalizedYes">Yes</label>
                        <input type="radio" id="rdHospitalizedNo" name="hospitalized" value="no" >
                        <label for="rdHospitalizedNo">No</label>
                    </div>
                </div>
                <div class="container ifYes unShow" id="hospitalized">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text">If so when and why?</span>
                        <input type="text" class="form-control ">
                    </div>
                </div>

                <!-- allergies -->
                <div class="input-group flex-nowrap question">
                    <span class="input-group-text">Any allergies</span>
                    <input type="text" class="form-control" placeholder="Put n/a if none">

                </div>

                <!-- pregnant -->
                <div class="container forFemales">
                    <h6>For Females</h6>
                    <div class="input-group flex-nowrap question">
                        <span class="input-group-text">Are you pregnant ? </span>
                        <div class="form-control no-border">
                            <input type="radio" id="rdPregnantYes" name="pregnant" value="yes">
                            <label for="rdPregnantYes">Yes</label>
                            <input type="radio" id="rdPregnantNo" name="pregnant" value="no" checked>
                            <label for="rdPregnantNo">No</label>
                        </div>
                    </div>
                    <div class="container ifYes w-75 unShow isPregnant" id="treatment">
                        <div class="input-group flex-nowrap ">
                            <span class="input-group-text">Ilan months?</span>
                            <input type="text" class="form-control " id="monthPregnant" onkeypress="return onlyNumberKey(event)" required maxlength="2">
                        </div>
                    </div>
                    <div class="input-group flex-nowrap question">
                        <span class="input-group-text">Are you taking birth control pills ? </span>
                        <div class="form-control no-border">
                            <input type="radio" id="rdPillsYes" name="pills" value="yes" checked>
                            <label for="rdPillsYes">Yes</label>
                            <input type="radio" id="rdPillsNo" name="pills" value="no" checked>
                            <label for="rdPillsNo">No</label>
                        </div>
                    </div>

                </div>

                <!-- Medical History end -->
            </div>
        </div>

        <!-- Social History  -->
        <div class="row serviceFormCategory  ">
            <h3>Social History</h3>
            <div class="container questionCategoryWrapper">

                <!-- medical smoke -->
                <div class="input-group flex-nowrap ">
                    <span class="input-group-text">Do you smoke?</span>
                    <div class="form-control no-border">
                        <input type="radio" id="rdSmokeYes" name="smoke" value="yes">
                        <label for="rdSmokeYes">Yes</label>
                        <input type="radio" id="rdSmokeNo" name="smoke" value="no">
                        <label for="rdSmokeNo">No</label>
                    </div>
                </div>

                <!-- medical alcohol -->
                <div class="input-group flex-nowrap ">
                    <span class="input-group-text">Do you drink alcoholic beverages</span>
                    <div class="form-control no-border">
                        <input type="radio" id="rdAlcoholicYes" name="alcoholic" value="yes">
                        <label for="rdAlcoholicYes">Yes</label>
                        <input type="radio" id="rdAlcoholicNo" name="alcoholic" value="no">
                        <label for="rdAlcoholicNo">No</label>
                    </div>
                </div>
            </div>
            <!-- Social History end  -->
        </div>

        <!-- Conditions  -->
        <div class="row serviceFormCategory  ">
            <h5>Please mark if you have or you had any of the following conditions:</h5>
            <div class="container questionCategoryWrapper">
                <div class="condtionsCheckBox">
                    <?php
                    $conditions = array(
                        "High Blood Pressure",
                        "Low Blood Pressure",
                        "Diabetes",
                        "Heart Disease / Heart Attack",
                        "Seizures / Epilepsy / Stroke",
                        "Thyroid Problem",
                        "Asthma",
                        "Bleeding Problem",
                        "Arthritis / Rheumatism",
                        "Liver Disease",
                        "Cancer"
                    );
                    $i = 0;
                    $arrayLength = count($conditions);
                    while ($i < $arrayLength) {
                        $num = $i + 1;
                        echo <<<CONDITIONS
                        <div>
                        <input type="checkbox" id="conditions$num" name="conditions" value="$conditions[$i]">
                        <label for="conditions$num"> $conditions[$i]</label></div>

                    CONDITIONS;

                        $i++;
                    }
                    ?>

                </div>
                <div class="addConditionWrapper" >
                    <label for="conditionsOther" class="fs-6">Other condition : </label>
                    <input type="text" id="conditionsOther"  class="inputNewConditions" autocapitalize="words" autofocus>
                    <button type="button" id="addNewCondition"> Add this condition</button>
                </div>
            </div>
            <!-- Conditions History end  -->
        </div>

        <!-- NOte  -->
        <div class="row serviceFormCategory  ">
            <div class="container questionCategoryWrapper">
                <p>     
                        I understand that <strong>DENTISTRY</strong> is not an exact Science & that no dentist can properly guarantee results. It is my responsibility to
                    inform the dentist of any medical condition/any medication I am taking. I hereby authorize the dentist to proceed & perform
                    the treatment's as explained to me. I understand that I am responsible for the payment of all dental fees. I agree to pay any
                    attorney's fee, or court costs that may be incurred to satisfy any obligation to this office. Any untoward circumstances that may
                    arise during the procedure, the dentist will not be held liable since it is my free will, with full trust and confidence in her, to
                    undergo dental treatment under her care.
                </p>
                <div>
                        <input type="checkbox" id="agree" name="agree" value="agree">
                        <label for="agree" class="agreeLabel" > I confirm that I have read, understand and agree to the statement above. </div>
            </div>
            <!-- notey end  -->
        </div>
    </div>
</div>

<div class="appoinmentDetails">
    <div class="row ">

        <div class="container patient-details ">
            <h5 class="w-auto">Fill-up your details</h5>
            <div class="row">
                <div class="col patientId-form">
                    <div class="form-floating  patient-inputs">
                        <input type="text" class="form-control " id="patientId" placeholder="Your Patient ID" onkeypress="return onlyNumberKey(event)" required maxlength="4">
                        <label for="patientId">Patient ID</label>
                    </div>

                    <a href="registration.php" class=" patientID-input unShow">New Patient?</a>
                    <a class=" patientID-input unShow">Forgot Patient Id?</a>
                    <div id="patientIdError" class="unShow">asdad</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col patientId-form">
                        <div class="form-floating  patient-inputs">
                            <input type="text" class="form-control " id="patientContact" placeholder="Your Contact number" onkeypress="return onlyNumberKey(event)" required maxlength="11">
                            <label for="patientId">Contact Number</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container patient-bookDetails">
            <h5 class="w-auto">Booking Details:</h5>
            <br>
            <div class="row">
                <h6>Choosed Service/s</h6>
                <div class="servicesChoosed ">
                    <table class="table  table-borderless choosedServiceTable">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST["serviceName"])) {
                                $svName = $_POST["serviceName"];
                                $svId = $_POST["serviceID"];
                                $svPrice = $_POST["servicePrice"];
                                echo <<<SERVICEROW
                                        <tr class="choosedServiceRow">
                                            <td>$svName</td>
                                            <td class="serviceId">$svId</td>
                                            <td class="servicePrice">$svPrice </td>
                                            <td><button type="button" class="btn-close removeService"></button></td>
                                        </tr>
                                    SERVICEROW;
                            }
                            ?>
                            <!-- <tr class="choosedServiceRow">
                                <td>Surture</th>
                                <td class="serviceId">500</td>
                                <td>500</td>
                                <td><button type="button" class="btn-close"></button></td>
                            </tr> -->

                        <tfoot>
                            <tr class="totalAmountRow">
                                <th>Minimum payment: </th>
                                <th class="w-auto" id="totalAmountofAppoinment"></th>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row w-75">
                <h6>Date and Time: </h6>
                <div class="container">
                    <div class="container">
                        <div class="row w-75">
                            <span id="appointmentDate_WeekDay" class="choosedAppointmentDate"></span>
                            <span id="appointmentDate_YearMonthDay" class="choosedAppointmentDate"></span>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row w-75">
                            <span id="appointmentTime"></span>
                        </div>
                    </div>
                </div>
                <p></p>
            </div>

            <div class="row w-75">
                <h6>Patient Details: </h6>
                <div class="container w-100">
                    <div class="container ">
                        <div class="input-group ">
                            <span class="input-group-text">Patient ID: </span>
                            <input type="text" class="form-control" id="appointmentPatientId">
                        </div>

                    </div>
                    <div class="container">
                        <div class="input-group ">
                            <span class="input-group-text">Contact No.: </span>
                            <input type="text" class="form-control" id="appointmentPatientContact">
                        </div>
                    </div>
                </div>



            </div>

            <div class="row w-100 ">
                <button type="button" id="btnBackAppointment" class="buttonAppointment unShow">Back to edit Appointment</button>
                <button type="button" id="btnProceedAppointment" class="buttonAppointment">Proceed</button>
            </div>





        </div>

        <div class="container patient-TransactionWay unShow ">
            <div class="row">
                <div class="input-group ">
                    <span class="input-group-text">Patient ID: </span>
                    <input type="text" class="form-control" id="patientIdSubmitted">
                </div>
                <div class="input-group ">
                    <span class="input-group-text">Appointment # </span>
                    <input type="text" class="form-control" id="appointmentCode">
                </div>
                <div class="input-group ">
                    <span class="input-group-text">SubTotal Amount: </span>
                    <input type="text" class="form-control" id="appointmentSubTotalAmount">
                </div>
                <div class="container">
                    <br>
                    <span>How do you want to pay?</span>

                    <div class="container payment">
                        <input type="radio" id="gcash" name="payment" value="GCash" checked>
                        <label for="gcash">GCash</label><br>
                        <input type="radio" id="rdPayLayer" name="payment" value="PayLater">
                        <label for="rdPayLayer">I want to pay later</label><br>

                        <br>
                        <p> Note: This is just an initial payment. Total amount may
                            still change after the appointment is done.</p>

                    </div>
                </div>
                <div class="container w-75">
                    <div class="row w-100 ">
                        <button type="button" id="btnSubmitAppointment" class="buttonAppointment">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>