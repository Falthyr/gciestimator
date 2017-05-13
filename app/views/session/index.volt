{{ content() }}

<div class="row">
    <div class="col-md-6">
        <div class="page-header">
            <h2>Log In</h2>
        </div>
        {{ form('session', 'role': 'form') }}
            <fieldset>
                <div class="form-group">
                    <label for="email">User ID</label>
                    <div class="controls">
                        {{ text_field('user_id', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="controls">
                        {{ password_field('password', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    {{ submit_button('Login', 'class': 'btn btn-primary btn-large') }}
                </div>
            </fieldset>
        </form>
    </div>
</div>
