<!--<pre>
    <?php echo print_r($this->post, true) . print_r($this->metabox, true) . print_r($this->selected_teacher, true) ?>
</pre>-->


<table class="form-table">
    <tbody>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="dharma-talk-teacher">Teacher:</label>
            </th>
            <td>
                <select name="dharma_talk_teacher" id="dharma-talk-teacher">
                    <option value="">- Select -</option>
                    <?php echo $this->options($this->teachers, $this->selected_teacher) ?>
                </select>
            </td>
        </tr>
        <?php if (!empty($this->audio_file)) : ?>
            <tr class="form-field">
                <th scop="row" valign="top">
                    Current Audio File:
                </th>
                <td>
                    <?php echo $this->wp('wp_audio_shortcode', array(array('src' => $this->audio_file)))  ?>
                </td>
            </tr>
        <?php endif ?>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="dharma-talk-audio-file"><?php if (!empty($this->audio_file)) : ?>Upload a New <?php endif ?>Audio File:</label>
            </th>

            <td>
                <input id="dharma-talk-audio-file" type="file" accept=".mp3" name="dharma_talk_audio_file" value="" size="25" style="border:none"/>
            </td>
        </tr>
    </tbody>

</table>
