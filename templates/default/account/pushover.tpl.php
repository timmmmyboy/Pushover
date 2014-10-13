<div class="row">

    <div class="span10 offset1">
        <h1>Pushover</h1>
        <?=$this->draw('account/menu')?>
    </div>

</div>
<div class="row">
    <div class="span10 offset1">
        <form action="/account/pushover/" class="form-horizontal" method="post">
            <div class="control-group">
                <div class="controls">
                    <p>
                        To push notifications to your phone using Pushover, <a href="https://pushover.net/apps/build" target="_blank">create an application at Pushover.net</a> and get an API key, then enter it below along with your user key and device name (both accessible at <a href="http://pushover.net">http://pushover.net</a>.</p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="name">API Key</label>
                <div class="controls">
                    <input type="text" id="pushapikey" placeholder="API Key" class="span4" name="pushapikey" value="<?=htmlspecialchars(\Idno\Core\site()->config()->pushover['apikey'])?>" >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="name">User Key</label>
                <div class="controls">
                    <input type="text" id="pushuserkey" placeholder="User Key" class="span4" name="pushuserkey" value="<?=htmlspecialchars(\Idno\Core\site()->config()->pushover['userkey'])?>" >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="name">Device Name (leave blank for all devices)</label>
                <div class="controls">
                    <input type="text" id="pushdevicename" placeholder="Device Name" class="span4" name="pushdevicename" value="<?=htmlspecialchars(\Idno\Core\site()->config()->pushover['devicename'])?>" >
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <?= \Idno\Core\site()->actions()->signForm('/account/pushover/')?>
        </form>
    </div>
</div>
