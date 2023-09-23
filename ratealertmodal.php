<span class="frm-pop-bg"></span>
    <div class="alrt-form-area">
        <div class="container">
            <div id="alert-frm">
                <span class="alrt-close-icon"><img src="./images/close.png" alt=""></span>
                <div class="each-rate-frm">
                    <label for="">Currency</label>
                    <select class="form-select" id="currency" aria-label="Default select example">
                        <!-- <option selected>USD-INR</option> -->
                        <!-- <option value="USD">USD-INR</option> -->
                        <option value="USD">USD-INR</option>
                        <option value="GBP">GBP-INR</option>
                        <option value="AUD">AUD-INR</option>
                        <option value="CAD">CAD-INR</option>
                        <option value="NZD">NZD-INR</option>
                        <option value="AED">AED-INR</option>
                        <option value="SGD">SGD-INR</option>
                    </select>
                    <span id="currency-error-msg" class="frm-error-msg"></span>
                </div>
                <div class="each-rate-frm">
                    <label for="">Rate Type</label>
                    <select class="form-select" id="rate_type" aria-label="Default select example">
                        <option value="1">BID</option>
                        <option value="2">ASK</option>
                    </select>
                    <span id="rate-type-error-msg" class="frm-error-msg"></span>
                </div>
                <div class="each-rate-frm">
                    <label for="">Operator</label>
                    <select class="form-select" id="operator" aria-label="Default select example">
                        <option value="1">></option>
                        <option value="2"><</option>
                    </select>
                    <span id="operator-error-msg" class="frm-error-msg"></span>                    
                </div>
                <div class="each-rate-frm">
                    <label for="exampleFormControlInput1" class="form-label">Target Rate </label>
                    <input type="number" id="target_rate" class="form-control" placeholder="82.2050">
                    <span id="target-rate-error-msg" class="frm-error-msg"></span>
                </div>
                <div class="each-rate-frm">
                    <label for="exampleFormControlInput1" class="form-label">WhatsApp Number </label>
                    <input type="number" id="mobile_number" class="form-control" placeholder="Enter Your Mobile Number">
                    <span id="mobile-number-error-msg" class="frm-error-msg"></span>
                </div>
                <span id="form-submit-msg"></span>
                <div class="d-flex justify-content-between mt-6">
                    <button class="rate-cncl-btn">Cancel</button>
                    <button class="rate-sv-btn">Save</button>
                </div>
              </div>
        </div>
    </div>