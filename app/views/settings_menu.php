<div id="theme-options-wrap">
    <h2>Audio Dharma Mp3 Metadata Settings</h2>
    <p>Enter in the values for the following metadata properties.</p>
    <p>The information on this page comes from <a href="http://id3.org/id3v2.4.0-frames" target="_blank">ID3.org</a>, where you can find a complete reference to all available ID3 tags.</p>
    <form method="post">
        <table class="form-table" style="width:900px">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="tcop" value="Copyright Message">Copyright Message</label>
                    </th>
                    <td>
                        <textarea name="settings[tcop]" id="tcop" rows="4" cols="75"><?php echo $this->e($this->settings['tcop']) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="description">The 'Copyright message' frame must begin with a year and a space character (making five characters). If you omit the year and space, this plugin will automatically add the current year. Every time this field is displayed, it must be preceded with "Copyright © ".</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="wcop" value="Copyright/Legal Information">Copyright / Legal Information</label>
                    </th>
                    <td>
                        <input name="settings[wcop]" id="wcop" size="75" value="<?php echo $this->e($this->settings['wcop']) ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="description">The 'Copyright/Legal information' frame is a URL pointing at a webpage where the terms of use and ownership of the file is described.</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="submit">
            <input name="Submit" type="submit" class="button-primary" value="Save Changes" />
        </p>
    </form>
</div>
