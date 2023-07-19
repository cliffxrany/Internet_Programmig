<!DOCTYPE html>
<html>
<head>
    <title>Premier League Teams</title>
    <script>
        /*
        JavaScript function to enable/disable form elements
        This function is called whenever the radio buttons are changed,
        and it enables or disables the other form elements based on the selection.
        */
        function toggleFormElements() {
            // Get the selected radio button
            var radioBtn1 = document.getElementById("radioBtn1");
            var radioBtn2 = document.getElementById("radioBtn2");

            // Get all other form elements
            var otherElements = document.getElementsByClassName("formElement");

            // If the first radio button is selected, disable other form elements
            if (radioBtn1.checked) {
                for (var i = 0; i < otherElements.length; i++) {
                    otherElements[i].disabled = true;
                }
            } else {
                // If the second radio button is selected, enable other form elements
                for (var i = 0; i < otherElements.length; i++) {
                    otherElements[i].disabled = false;
                }
            }
        }
    </script>
</head>
<body>
    <!-- <section> tags are used to enclose a logical section of the web page, in this case, the Premier League Teams form. -->
    <section>
        <h2>Premier League Teams</h2>

        <form>
            <p>
                <!-- The first radio button -->
                <label for="radioBtn1">
                    <input type="radio" id="radioBtn1" name="radioBtn" onchange="toggleFormElements()">
                    I don't watch football
                </label>
            </p>
            <p>
                <!-- The second radio button -->
                <label for="radioBtn2">
                    <input type="radio" id="radioBtn2" name="radioBtn" onchange="toggleFormElements()">
                    I watch football
                </label>
            </p>

            <p>
                <label for="selectBox">Select Premier League Team:</label>
                <!-- Select drop-down element with all 20 Premier League teams -->
                <select id="selectBox" class="formElement" disabled>
                    <option value="arsenal">Arsenal</option>
                    <option value="astonvilla">Aston Villa</option>
                    <option value="brentford">Brentford</option>
                    <option value="brighton">Brighton & Hove Albion</option>
                    <option value="burnley">Burnley</option>
                    <option value="chelsea">Chelsea</option>
                    <option value="crystalpalace">Crystal Palace</option>
                    <option value="everton">Everton</option>
                    <option value="leedsunited">Leeds United</option>
                    <option value="leicester">Leicester City</option>
                    <option value="liverpool">Liverpool</option>
                    <option value="mancity">Manchester City</option>
                    <option value="manunited">Manchester United</option>
                    <option value="newcastle">Newcastle United</option>
                    <option value="norwich">Norwich City</option>
                    <option value="southampton">Southampton</option>
                    <option value="tottenham">Tottenham Hotspur</option>
                    <option value="watford">Watford</option>
                    <option value="westham">West Ham United</option>
                    <option value="wolves">Wolverhampton Wanderers</option>
                </select>
            </p>

            <p>
                <label for="textInput">What is your name:</label>
                <!-- Text input element -->
                <input type="text" id="textInput" class="formElement" disabled>
            </p>

            <p>
                <label for="textArea">Say something about your club:</label>
                <!-- Text area element -->
                <textarea id="textArea" class="formElement" rows="4" cols="30" disabled></textarea>
            </p>

            <p>
                <label for="checkBox1">
                    <input type="checkbox" id="checkBox1" class="formElement" disabled>
                    I like this
                </label>
            </p>

            <p>
                <label for="checkBox2">
                    <input type="checkbox" id="checkBox2" class="formElement" disabled>
                    I don't like this
                </label>
            </p>

            <!-- Submit button -->
            <input type="submit" value="Submit" class="formElement" disabled>
        </form>
    </section>

    <script>
        // Execute the toggleFormElements() function initially to set the initial state based on radio button selection
        toggleFormElements();
    </script>
</body>
</html>