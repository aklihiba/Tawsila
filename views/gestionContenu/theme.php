<form action="<?= PRE ?>/GestionContenu/theme" method="post">
<div class='container'>
    <div class='row'>
        <div class='col'>
            <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header">Theme 1</div>
            <div class="card-body ">
            <div class='container'>
            <div class='row'>
            
            <div class='col' style="height: 30px; width:30px; background-color: #eee7d2; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #a58373; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #86b695; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #9a947e; border: 1px solid gray;"></div>
            </div>
            </div>

            </div>
            <div class="card-footer ">
            <input type="submit" class='mediumbutton' name="theme1" value='appliquer'>
            </div>
            </div>  
        </div>

        <div class='col'>
            <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header">Theme 2</div>
            <div class="card-body ">
            <div class='container'>
            <div class='row'>
            
            <div class='col' style="height: 30px; width:30px; background-color: #fbf9f3; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #628dbc; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #ceb9ad; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #aaaab2; border: 1px solid gray;"></div>
            </div>
            </div>

            </div>
            <div class="card-footer ">
            <input type="submit" class='mediumbutton' name="theme2" value='appliquer'>
            </div>
            </div>  
        </div>

        <div class='col'>
            <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header">Theme 3</div>
            <div class="card-body ">
            <div class='container'>
            <div class='row'>
            
            <div class='col' style="height: 30px; width:30px; background-color: #ded3b4; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #837069; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #78b1c2; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #7f8586; border: 1px solid gray;"></div>
            </div>
            </div>

            </div>
            <div class="card-footer ">
            <input type="submit" class='mediumbutton' name="theme3" value='appliquer'>
            </div>
            </div>  
        </div>

        <div class='col'>
            <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header">Theme 4</div>
            <div class="card-body ">
            <div class='container'>
            <div class='row'>
            
            <div class='col' style="height: 30px; width:30px; background-color: #e7dacb; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #7d5f6a; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #ebaeae; border: 1px solid gray;"></div>
            <div class='col' style="height: 30px; width:30px; background-color: #a0888a; border: 1px solid gray;"></div>
            </div>
            </div>

            </div>
            <div class="card-footer ">
                <input type="submit" class='mediumbutton' name="theme4" value='appliquer'>
            </div>
            </div>  
        </div>
    </div>
</div>
<div class='container'>
    <div class='row'>
        <div class='col'>
        <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header">police des titres</div>
            <div class="card-body ">
            
                <select class="custom-select" id="font1" name="font1select" style=" background-color:<?= $couleur->bgcolor() ?> ;" >
                <option value="fantasy" selected style="font-family: fantasy;">fantasy</option>
                  <option value="Marker Felt" style="font-family: Marker Felt;">Marker Felt</option>
                  <option value="Times New Roman" style="font-family: Times New Roman;">Times New Roman</option>
                  <option value="cursive" style="font-family: cursive;">cursive</option>
                  <option value="Bradley Hand" style="font-family: Bradley Hand;">Bradley Hand</option>
                  <option value="Brush Script MT" style="font-family: Brush Script MT;">Brush Script MT</option>
                  <option value="Apple Chancery" style="font-family: Apple Chancery;">Apple Chancery</option>
                  <option value="Comic Sans" style="font-family:Comic Sans;">Comic Sans</option>
                  <option value="Courier New" style="font-family: Courier New;">Courier New</option>
                  <option value="monospace" style="font-family:  monospace;">monospace</option>
                  <option value="American Typewriter" style="font-family: American Typewriter;">American Typewriter</option>
                  <option value="Arial" style="font-family: Arial;">Arial</option>
                  <option value="Helvetica" style="font-family:Helvetica;">Helvetica</option>
                  <option value="Verdana" style="font-family: Verdana;">Verdana</option>
                
                
                </select>

            </div>
            <div class="card-footer ">
            <input type="submit" class='mediumbutton' name="font1" value='appliquer'>
            </div>
            </div> 
        </div>
        <div class='col'>
        <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header">police des paragraphes</div>
            <div class="card-body ">
            
                <select class="custom-select" id="font2" name="font2select" style=" background-color:<?= $couleur->bgcolor() ?> ;" >
                  <option value="fantasy" selected style="font-family: fantasy;">fantasy</option>
                  <option value="Marker Felt" style="font-family: Marker Felt;">Marker Felt</option>
                  <option value="Times New Roman" style="font-family: Times New Roman;">Times New Roman</option>
                  <option value="cursive" style="font-family: cursive;">cursive</option>
                  <option value="Bradley Hand" style="font-family: Bradley Hand;">Bradley Hand</option>
                  <option value="Brush Script MT" style="font-family: Brush Script MT;">Brush Script MT</option>
                  <option value="Apple Chancery" style="font-family: Apple Chancery;">Apple Chancery</option>
                  <option value="Comic Sans" style="font-family:Comic Sans;">Comic Sans</option>
                  <option value="Courier New" style="font-family: Courier New;">Courier New</option>
                  <option value="monospace" style="font-family:  monospace;">monospace</option>
                  <option value="American Typewriter" style="font-family: American Typewriter;">American Typewriter</option>
                  <option value="Arial" style="font-family: Arial;">Arial</option>
                  <option value="Helvetica" style="font-family:Helvetica;">Helvetica</option>
                  <option value="Verdana" style="font-family: Verdana;">Verdana</option>
                  
                
                </select>

            </div>
            <div class="card-footer ">
            <input type="submit" class='mediumbutton' name="font2" value='appliquer'>
            </div>
            </div> 
        </div>
    </div>
</div>
</form>


