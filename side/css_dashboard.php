<style>
body {
            font-family: "Lato", arial ;
            background-color: #FFF0F0;
            padding: 0%;
            margin: 0%;
        }
        .navbar {
            border: 1px solid;
            background-color: #000000;
            height: 50px;
            display: flex;
            align-items: center;
        }
        .pic0 {
            border-color: white;
            height: 80%;
            margin-left: 10px;
        }
        .option {
            border-color: white;
            padding: 10px;
            margin-right: 10px;
            margin-left: auto;
        }
        .a {
            margin-left: 5px;
            padding: 5px;
            text-decoration: none;
            font-size: 25px;
            color: #AACA00;
        }
        .a:hover {
            background-color: #FFF0F0;
        }
        .header {
            height: 450px;
            overflow: hidden;
        }
        .pic1 {
            height: 200%;
            width: 100%;
            margin-top: -100px;
            
        }
        .sidebar {
            width: 300px;
            position: fixed;
            top: 0%;
            height: 100vh;
            background-color: #F6F1F1;
            display: none;
            margin: 0%;
            padding: 0%;
        }

        .text-body {
            font-size: 40px;
            width: 580px;
            margin: 50px;
            text-shadow: 1px 1px 1px black;
        }
        


        .services {
      
            padding: 10px;
            display: grid;
            grid-template-columns: auto auto auto;
        }
        .cardd1{
   
            padding: 10px;
            display: flex;
            justify-content: center;
        }
        .card1 {
            width: 300px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 10px;
            border-radius: 10px;
            background-color: #F0FFFF;
        }
        .pic2 {
            border-radius: 10px;
            width: 100%;
            height: 200px;
        }
        .text2 {
        
            padding: 10px;
            font-size: 25px;
            text-align: center;
        }
        .price {
            font-size: 30px;
            text-align: center;
            font-weight: 600;
            text-decoration: underline;
        }

        /* bofy part */
        .bodydiv {
            margin-top: 50px;
            height: 500px;
            background-image: url("images/bg.png");
            display: grid;
            grid-template-columns: auto auto;
            
        }
       .pic_bg {
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
       }
       .content_promotion {
            padding: 10px;
            display: flex;
            align-items: center;
       }
       .disp {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            width: 100%;
            height: 100%;
            border-radius: 20px;
            
       }
       .pic_bg2 {
            padding: 10px;
            width: 500px;
            height: 350px;
       }

       .parent_promote {
            width: 500px;
            padding: 10px;
            background-color: #FFF0F0;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
       }


       .promote {
            font-family: Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-size: 70px;
            color: #614D4F;
            text-shadow: 2px 2px #000000;
            letter-spacing: 5px;
            margin-left: 20px;
       }
       .pg {
        padding: 10px;
            font-size: 20px;
       }
       .link {
            border-radius: 10px;
            background-color: #6B4A4A;
            color: white;
            border: 1px solid;
            width: 200px;
            height: 50px;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
       }

       /* footer */
       .footerr {
            background-color: #3F3F3F;
            padding: 10px;
            margin-top: 200px;
            height: 400px;
       }

       .info11 {
            width: 60%;
            display: flex;
            font-weight: 600;
            font-size: 25px;
            letter-spacing: 3px;
       }
       .red1 {
            width: 20px;
            height: 65px;
            background-color: red;
            margin-right: 20px;
       }
       .info2 {
            margin-top: 60px;
            display: grid;
            grid-template-columns: auto auto;
       }
       .ct1 {
            display: flex;
            font-weight: 600;
            font-size: 25px;
            letter-spacing: 3px;
            display: flex;
            flex-direction: column;
       }
       .iconn {
            width: 50px;
       }
       .red2 {
            width: 10px;
            height: 100%;
            background-color: red;
            display: flex;
            flex-direction: column;
       }
       .img_contain {
            display: flex;
            width: 400px;
       }
       .follow {
            margin-left: 20px;
            width: 200px;
       }
       .iconn {
            padding-top: 10px;
            margin-left: 20px;
       }
       .linkk {
            margin-left: 20px;
            font-size: 20px;
            color: #000000;
            text-decoration: none;
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
</style>