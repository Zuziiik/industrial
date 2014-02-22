<?php

include_once 'View.php';

class RegisterView extends View {

    function __construct($model) {
        parent::__construct($model);
    }

    public function initialize() {

    }

    public function printBody() {
        global $loggedIn;
        if (!$loggedIn) {
            echo($this->model->error);
            echo <<<_END
           <form name='login' method='post' action='./index.php?page=register'>
                <table>
                    <tr>
                        <td>
                        <label for='name'>Username:</label>
                        </td>
                        <td>
                        <input id='name' name='user' value='
_END;
            $this->model->user;
            echo <<<_END
' type='text'/>
                        </td>
                        <td>
_END;
            echo($this->model->errorUser);
            echo <<<_END
                        </td>
                     </tr>
                        <tr>
                        <td>
                        <label for='email'>Email:</label>
                        </td>
                        <td>
                        <input id='email' name='email' value='
_END;
            $this->model->email;
            echo <<<_END
' type='text'/>
                        </td>
                        <td>
_END;
            echo($this->model->errorEmail . "  " . $this->model->errorEmailFormat);
            echo <<<_END
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <label for='pass1'>Password:</label>
                        </td>
                        <td>
                        <input id='pass1' name='pass1' type='password'/>
                        </td>
                        <td>
_END;
            echo($this->model->errorPass);
            echo <<<_END
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label for='pass2'>Repeat Password:</label>
                        </td>
                        <td>
                        <input id='pass2' name='pass2' type='password'/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        
                        </td>
                        <td>
                        <input type='submit' name='submit'/>
                        </td>
                    </tr>
                </table>
            </form>
_END;
            echo $this->model->msg;
        } else {
            echo $this->model->error;
        }
    }

    public function printPageHeader() {
        echo("Register");
    }

    public function printTitle() {
        echo("Register");
    }

}
