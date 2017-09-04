
            <form method="POST"></form>
                <p class="form__title">Registration</p>
                <div class="form__input-wrapper">
                    <label class="form__label form__ladel--email" for="input-email">Your E-mail</label>
                    <input type="text" name="newEmail" class="form__input form__input--email" id="input-email"
                    value="email"/>
                    <label class="form__label form__label--password" for="input-password">Your Password</label>
                    <input type="text" name="newPassword" class="form__input form__input--password" id="input-password"
                    value="password"/>

                    <div class="form__captcha-wrapper" style="display:none;>
                        <p class="form__label form__captcha-text">Secure code</p>
                        <div class="form__captcha-pic">
                            <img src="" class="form__captcha-image" alt="captcha">
                        </div>
                        <input type="text" name="captcha" class="form__input form__input--captcha" id="input-captcha" />
                        <button class="form__button form__button--captcha" onclick="checkCaptcha('register')">Check</button>
                    </div>

                    <div class="form__wrapper">
                        <button class="form__button form__button--reg-submit" onClick="register()">Register</button>
                    </div>                  
                </div>
                <p class="form__warning"></p>
            </form>
