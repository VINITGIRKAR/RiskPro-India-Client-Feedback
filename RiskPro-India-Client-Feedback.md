# RiskPro-India-Client-Feedback
view-source:https://forms.office.com/Pages/ResponsePage.aspx?id=98HgoZL75UC5jM0TLUozA659CCCR0TtLjULxqBS7W9JURFMxNzlBREowMFdZMFE0TFdBV05YVUhJVS4u&origin=Invitation&channel=0

https://forms.office.com/Pages/ResponsePage.aspx?id=98HgoZL75UC5jM0TLUozA659CCCR0TtLjULxqBS7W9JURFMxNzlBREowMFdZMFE0TFdBV05YVUhJVS4u&origin=Invitation&channel=0

PHP SUBMIT FILE ISSUE RESOLUTION:

Thanks for sharing the screenshot — the issue is now clear:

> 🔴 **Your PHP code is being displayed in the browser instead of being executed.**

### ✅ Root Cause:

You are opening the PHP file directly via **`file:///C:/Users/vinit/submit.php`**, which means you're using a local file path, **not a web server**. This causes the browser to show the raw code instead of executing it.

### 🛠️ Solution: Use a local server like XAMPP or WAMP

#### ✅ Option 1: XAMPP (Recommended for beginners)

1. **Download & Install XAMPP**:
   Get it from [https://www.apachefriends.org](https://www.apachefriends.org)

2. **Start Apache** using the XAMPP Control Panel.

3. **Move your project** (HTML + PHP files) into the `htdocs` folder.
   For example:
   `C:\xampp\htdocs\feedback\submit.php`

4. **Access it in your browser** like this:
   `http://localhost/feedback/submit.php`

#### ✅ Option 2: VS Code + PHP Server Extension

If you're using Visual Studio Code:

* Install the extension called **“PHP Server”**.
* Right-click your `submit.php` file and select **“PHP Server: Serve project”**.
* It will open a proper `http://localhost:...` URL where PHP will run.

---

### 🔁 After This:

* Visit your feedback form normally via `http://localhost/...`
* Fill the form and submit.
* The `submit.php` will now **execute properly**, not display code.

Would you like a step-by-step setup for XAMPP or the PHP server in VS Code?
