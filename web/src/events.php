
<?php



    class events{
        public $games;
        function __construct(){
    
        }
        function retrieve(){
            return $this->games;
        }

        function build($active_link){
           
            $events_retrieve = "SELECT game.id as 'game.id',game.typeId,game.date,gameType.type as 'gameType.type' FROM game LEFT JOIN gameType ON game.typeId=gameType.id";
            $events_retrieve_query = mysqli_query($active_link,$events_retrieve);
            $events_retrieve_query_row = mysqli_fetch_assoc($events_retrieve_query);
            $events_retrieve_query_amount = mysqli_num_rows($events_retrieve_query);

            for ($i=0; $i < $events_retrieve_query_amount; $i++) { 
                $this->games[$i] = new game();
                $this->games[$i]->build(    $events_retrieve_query_row['game.id'],
                                            $events_retrieve_query_row['typeId'],
                                            $events_retrieve_query_row['date'],
                                            $events_retrieve_query_row['gameType.type']);
                 $events_retrieve_query_row = mysqli_fetch_assoc($events_retrieve_query);
            }
        }


        function add($active_link){
            
        }


    }  
            
 
   function retrieve_events($active_link){
        $events = new events;
        $events->build($active_link);
        return $events;
   }


   function organize_events($receivedEvents)
    {
        for ($i=0; $i < count($receivedEvents->games); $i++) { ?>
            <div class='col-3 content'">
                <label>Date: <?= $receivedEvents->games[$i]->date ?></label>
                <br>
                <label>Type: <?= $receivedEvents->games[$i]->properties['type_desc'] ?></label>
                <hr>
                <a href="event.php?id=<?=$receivedEvents->games[$i]->id?>">
                    <input type='button' class="content" value='See Event'></input>
                </a>
            </div>
        <?php }
    }



?>