
            <form method="POST" class="form__edit"></form>
                <p class="form__title">My Profile</p>
                <div class="form__photo-wrapper">
                    <img src="<? echo $this->session->userdata('picture_url');  ?>" class="form__photo" alt="photo">
                </div>
                <div class="form__input-wrapper">

                    <label class="form__label form__ladel--nameF" for="input-nameF">First Name</label>
                    <input type="text" class="form__input form__input--nameF" id="input-nameF" name="nameF"/>

                    <label class="form__label form__ladel--nameS" for="input-nameS">Second Name</label>
                    <input type="text" class="form__input form__input--nameS" id="input-nameS" name="nameS"/>

                    <label class="form__label form__ladel--birth" for="input-birth">Birth Date</label>
                    <input type="text" class="form__input form__input--birth" id="input-birth" name="birth"/>

                    <label class="form__label form__ladel--email" for="input-email">Your E-mail</label>
                    <input type="text" class="form__input form__input--email" id="input-email" name="email"/>
                    
                    <label class="form__label form__label--password" for="input-password">Your Password</label>
                    <input type="password" class="form__input form__input--password" id="input-password" name="password"/>

                    <label class="form__label form__label--password-repeat" for="input-password-repeat">Repeate Password</label>
                    <input type="password" class="form__input form__input--password-repeat" id="input-password-repeat" name="passwordRpt"/>

                    <label class="form__label form__ladel--phone" for="input-phone">Phone</label>
                    <input type="text" class="form__input form__input--phone" id="input-phone" name="phone"/>

                    <label class="form__label form__ladel--country" for="input-country">Country</label>
                    <input type="text" class="form__input form__input--country" id="input-country" name="country"/>

                    <label class="form__label form__ladel--city" for="input-city">City</label>
                    <input type="text" class="form__input form__input--city" id="input-city" name="city"/>

                    <label class="form__label form__ladel--adress" for="input-adress">Adress</label>
                    <input type="text" class="form__input form__input--adress" id="input-adress" name="adress"/>

                    <label class="form__label form__ladel--post-index" for="input-post-index">Index</label>
                    <input type="text" class="form__input form__input--post-index" id="input-post-index" name="postIndex"/>
                    
                    <div class="form__wrapper">
                        <div class="form__upload">
                            <button class="form__button form__button--upload">Photo</button>
                            <input type="file" class="form__input form__input--file" id="input-file" onchange="uploadPhoto()">
                        </div>
                        <button class="form__button form__button--edit-submit" onclick="update()">Save</button>
                        <button class="form__button form__button--back" onclick="backToHome()">Back</button>
                    </div>
                </div>
            </form>
