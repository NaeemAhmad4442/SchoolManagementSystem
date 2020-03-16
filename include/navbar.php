<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">School Management System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home page">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home Page</span>
          </a>
        </li>
        
        <?php if($_SESSION["level"] == 3)
        {echo'
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notifiche">
          <a class="nav-link" href="manage_rooms.php">
            <i class="fa fa-fw fas fa-volume-up"></i>
            <span class="nav-link-text">Gestisci Aule</span>
          </a>
        </li>';
        }
        ?>

        <?php if($_SESSION["level"] == 2)
        {echo'
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notifiche">
          <a class="nav-link" href="send_notfication.php">
            <i class="fa fa-fw fas fa-volume-up"></i>
            <span class="nav-link-text">Invia Notifica</span>
          </a>
        </li>';
        }
        ?>
        <?php if($_SESSION["level"] == 1)
        {echo'
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notifiche">
          <a class="nav-link" href="taxes.php">
            <i class="fa fa-fw fas fa-table"></i>
            <span class="nav-link-text">Tasse</span>
          </a>
        </li>';
        }
        ?>
        <?php if($_SESSION["level"] == 3)
        {echo'
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notifiche">
          <a class="nav-link" href="vocations.php">
            <i class="fa fa-fw fas fa-volume-up"></i>
            <span class="nav-link-text">Vacanze</span>
          </a>
        </li>';
        }
        ?>
        <?php if($_SESSION["level"] == 0 || $_SESSION["level"] == 2)
        {echo'
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Veriche">
          <a class="nav-link" href="tests.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Verifiche</span>
          </a>
        </li>';
        }
        ?>
        
        
        <?php if($_SESSION["level"] == 2 || $_SESSION["level"] == 3 || $_SESSION["level"] == 4)
        {
            echo '
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Lista Utenti">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-user"></i>
                <span class="nav-link-text">Utenti</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
                <a class="nav-link" href="users.php?type=1">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">Lista genitori</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="users.php?type=0">
                <i class="fa fa-fw fa-user"></i>
                <span class="nav-link-text">Lista Studenti</span>
                </a>
            </li>';
        }
        if($_SESSION["level"]==3 || $_SESSION["level"] == 4)
        {
            echo '
            <li>
                <a class="nav-link" href="users.php?type=2">
                <i class="fa fa-fw fa-user"></i>
                <span class="nav-link-text">Lista Docenti</span>
                </a>
            </li>
            ';
        }


        if($_SESSION["level"] == 4)
        {
            echo '
            <li>
                <a class="nav-link" href="users.php?type=3">
                <i class="fa fa-fw fa-user"></i>
                <span class="nav-link-text">Lista Admin</span>
                </a>
            </li>';
        }    

        if($_SESSION["level"] == 2 || $_SESSION["level"] == 3 || $_SESSION["level"] == 4)
        {
            echo'</ul></li>';
        }

        if($_SESSION["level"] == 3 || $_SESSION["level"] == 4)
        {
            echo '
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Classi">
                <a class="nav-link" href="classes.php">
                    <i class="fa fa-fw fa-group"></i>
                    <span class="nav-link-text">Classi</span>
                </a>
            </li>';
        }
        ?>
        <?php
        if($_SESSION["level"] == 2)
        {
          echo '
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Appello">
          <a class="nav-link" href="presence.php">
            <i class="fa fa-fw fa-stop"></i>
            <span class="nav-link-text">Appello</span>
          </a>
          </li>
          ';
        }else if($_SESSION["level"] == 0)
        {
          echo '
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Appello">
          <a class="nav-link" href="presences.php">
            <i class="fa fa-fw fa-stop"></i>
            <span class="nav-link-text">Appello</span>
          </a>
          </li>
          ';
        }
        
        if($_SESSION["level"] == 2)
        {
          echo '
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Aggiungi note">
          <a class="nav-link" href="add_note.php">
            <i class="fa fa-fw fa-paperclip"></i>
            <span class="nav-link-text">Aggiungi Note</span>
          </a>
          </li>
          ';
        }else if($_SESSION["level"] == 0)
        {
          echo '
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Note">
          <a class="nav-link" href="notes.php">
            <i class="fa fa-fw fa-paperclip"></i>
            <span class="nav-link-text">Note</span>
          </a>
          </li>';
        }
        ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notifiche">
          <a class="nav-link" href="notifications.php">
            <i class="fa fa-fw fas fa-volume-up"></i>
            <span class="nav-link-text">Notifiche</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Contatta">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-support"></i>
                <span class="nav-link-text">Contatta</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents1">
            
          <?php
          if($_SESSION["level"]==4)
          {
            echo '
              <li>
                  <a class="nav-link" href="contact.php?type=2">
                      <i class="fa fa-fw fa-user"></i>
                      <span class="nav-link-text">Contatta Docente</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link" href="contact.php?type=3">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">Contatta Admin</span>
                  </a>
              </li></ul></li>';
          }
          else if($_SESSION["level"]==3)
          {
            echo '
              <li>
                  <a class="nav-link" href="contact.php?type=2">
                      <i class="fa fa-fw fa-user"></i>
                      <span class="nav-link-text">Contatta Docente</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link" href="contact.php?type=1">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">Contatta Genitore</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link" href="contact.php?type=0">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">Contatta Studente</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link" href="contact.php?type=4">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">Contatta Preside</span>
                  </a>
              </li></ul></li>
            
            ';
          }
          else if($_SESSION["level"]==2)
          {
              echo '
              <li>
                  <a class="nav-link" href="contact.php?type=3">
                      <i class="fa fa-fw fa-user"></i>
                      <span class="nav-link-text">Contatta Admin</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link" href="contact.php?type=1">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">Contatta Genitore</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link" href="contact.php?type=0">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">Contatta Studente</span>
                  </a>
              </li>
              </ul></li>
              ';
          }
          else if($_SESSION["level"]==1)
          {
            echo '
              <li>
                  <a class="nav-link" href="contact.php?type=2">
                      <i class="fa fa-fw fa-user"></i>
                      <span class="nav-link-text">Contatta Docente</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link" href="contact.php?type=1">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">Contatta Admin</span>
                  </a>
              </li>
              </ul></li>
              ';
          }
          else if($_SESSION["level"]==0)
          {
            echo '
              <li>
                  <a class="nav-link" href="contact.php?type=2">
                      <i class="fa fa-fw fa-user"></i>
                      <span class="nav-link-text">Contatta Docente</span>
                  </a>
              </li>
              <li>
                  <a class="nav-link" href="contact.php?type=3">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">Contatta Admin</span>
                  </a>
              </li>
              </ul></li>
              ';
          }
            
          ?>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>