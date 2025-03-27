<style>
        .sidebar {
            width: 300px;
            position: fixed;
            top: 0%;
            height: 100vh;
            background-color: #F6F1F1;
            display: none;
            margin: 0%;
            padding: 0%;
            z-index: 100;
        }
       /*  sidebar  */
       .upper {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
       }
       .upper1 {
        margin-top: 20px;
            display: flex;
            justify-content: center;
       }
       .upperpic {
            width: 60px;
       }
      
       .uppertext {
            font-size: 20px;
            margin-left: 10px;
            margin-top: 10px;
       }
       .uppertext_gmail {
            font-size: 10px;
            margin-left: 12px;
       }
       .logout {
            margin-top: 10px;
            font-size: 20px;
            text-decoration: none;
            color: #F6F1F1;
            background-color: #614D4F;
            text-align: center;
            border-radius: 10px;
            height: 30px;
            width: 200px;
       }
       .separate {
            margin-top: 20px;
            width: 100%;
            border: 1px solid;
       }


       /*   Body Sidebar   */
       .bodysidebar {

            width: 100%;
       }
       .img11 {
            width: 30px;
            margin-right: 10px;
            height: 30px;
       }
       .options {
            text-decoration: none;
            color: black;
            font-size: 20px;
            display: flex;
            background-color: #D9D9D933;
            justify-content: flex-start;
            padding-left: 50px;
            align-items: center;
            height: 60px;
       }
       .options:hover {
            background-color: #ded1d1;
       }

       @media (max-width: 768px) {
            .sidebar{
                width: 100px;
            }
            .options{
                font-size: 0px;
                padding-left: 30px;
            }
            .uppertext{
                font-size: 0px;
            }
            .uppertext_gmail{
                font-size: 0px;
            }
            .logout{
                width: 90px;
                font-size: 15px;
            }
        }

</style>