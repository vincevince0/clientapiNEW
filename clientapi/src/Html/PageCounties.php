<?php

namespace App\Html;
class PageCounties extends AbstractPage {
    static function table(array $entities)
    {
        echo '<h1>Megyék</h1>';
        self::searchBar();
        echo '<table id="counties-table">';
        self::tableHead();
        self::tableBody($entities);
        echo "</table>";
    }

    static function tableBody(array $entities)
{
    echo '<tbody>';
    $i = 0;
    foreach ($entities as $entity) {
        $onClick = sprintf(
            'btnEditCountyOnClick(%d, "%s")',
            $entity['id'],
            addslashes($entity['name']) 
        );
        echo "
        <tr class='" . (++$i % 2 ? "odd" : "even") . "'>
            <td>{$entity['id']}</td>
            <td>{$entity['name']}</td>
            <td class='flex float-right'>
            
                <button type='button'
                    id='btn-update-county-{$entity['id']}'
                    onclick='$onClick'
                    title='Módosít'>
                    <i class='fa fa-edit'></i> Módosítás
                </button>
                
                <form method='post' action=''>
                    <button type='submit'
                        id='btn-del-county-{$entity['id']}'
                        name='btn-del-county'
                        value='{$entity['id']}'
                        title='Töröl'>
                        <i class='fa fa-trash'></i> Töröl
                    </button>
                </form>
            </td>
        </tr>";
    }
    echo '</tbody>';
}


    static function tableHead()
    {
        echo '<thead>
        <tr>
            <th class="id-col">#</th>
            <th>Megnevezés</th>
            <th>Műveletek&nbsp</th>
            '
            ;
            self::editor();
  
    }
    //<button>Művelet</button>

    //<th style="float: left;>
    //Művelet&nbsp;
    //</th>


    static function editor()
    {
        // Edit County Form
        echo '
        <div id="county-editor" class="editor-container">
            <h3 id="editor-title">Edit County</h3>
            <form name="county-editor-form" method="post" action="">
                <input type="hidden" id="id" name="id">
                <input type="text" id="name" name="name" placeholder="Megye" required>
                <button type="submit" id="btn-save-county" name="btn-save-county" title="Mentés">
                    <i class="fa fa-save"></i> Mentés
                </button>
                <button type="button" id="btn-cancel-county" title="Mégse" onclick="cancelEdit()">
                    <i class="fa fa-cancel"></i> Mégse
                </button>
            </form>
        </div>
        ';
    
      
        echo '
        <div id="new-county-editor" class="editor-container" style="display:none;">
            <h3 id="new-county-title">Add New County</h3>
            <form name="new-county-editor-form" method="post" action="">
                <input type="hidden" id="new-id" name="id">
                <input type="text" id="new-name" name="name" placeholder="Megye" required>
                <button type="submit" id="btn-save-new-county" name="btn-save-new-county" title="Mentés">
                    <i class="fa fa-save"></i> Mentés
                </button>
                <button type="button" id="btn-cancel-new-county" title="Mégse" onclick="cancelAdd()">
                    <i class="fa fa-cancel"></i> Mégse
                </button>
            </form>
        </div>
        ';
    }
    

    public function searchCounty($needle)
    {
        $sql = "SELECT * FROM counties WHERE (county) LIKE '%$needle%'";
        $stmt = $this->mysqli->prepare($sql);
       $result =$this->mysqli->query($sql);
      
       if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $counties[] = $row;
        }
       }

       return $counties;
    }

}

