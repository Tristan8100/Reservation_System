<style>
    .sidebar {
        width: 300px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        background-color: #F6F1F1;
        display: none;
        margin: 0;
        padding: 0;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        z-index: 1000;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .pic0{
        width: 50px;
        margin-top: 10px;
        margin-left: 10px;
    }

    .uppertext_container, 
    .options, 
    .menu-text {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .upper {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 25px 0 15px;
    }

    .upper1 {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 0 25px;
        margin-bottom: 15px;
    }

    .upperpic {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .uppertext_container {
        margin-left: 15px;
        min-width: 0; /* Prevents text overflow */
    }

    .uppertext {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .uppertext_gmail {
        font-size: 12px;
        color: #666;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .logout {
        margin-top: 10px;
        font-size: 14px;
        text-decoration: none;
        color: #F6F1F1;
        background-color: #614D4F;
        text-align: center;
        border-radius: 6px;
        height: 36px;
        width: calc(100% - 50px);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.9s ease;
    }

    .logout:hover {
        background-color: #534042;
        transform: translateY(-1px);
    }

    .separate {
        margin: 10px 25px;
        border: none;
        border-top: 1px solid #ddd;
    }

    .bodysidebar {
        width: 100%;
        padding: 10px 0;
    }

    .img11 {
        width: 22px;
        height: 22px;
        margin-right: 15px;
        transition: all 0.3s ease;
    }

    .options {
        text-decoration: none;
        color: #333;
        font-size: 14px;
        display: flex;
        align-items: center;
        height: 46px;
        padding: 0 25px;
        margin: 2px 0;
        transition: all 0.9s ease;
        background-color: transparent;
    }

    .options:hover {
        background-color: #e8e2e2;
    }

    .options span {
        white-space: nowrap;
    }

    .nested {
        padding-left: 60px;
        font-size: 13px;
        color: #555;
    }

    .popi-container {
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 80px;
        }
        
        .upper1 {
            flex-direction: column;
            align-items: center;
            padding: 0 10px;
            text-align: center;
        }
        
        .uppertext_container {
            margin-left: 0;
            margin-top: 8px;
            width: 100%;
        }
        
        .uppertext, 
        .uppertext_gmail, 
        .options span {
            display: none;
        }
        
        .logout {
            width: 60px;
            font-size: 0;
        }
        
        .logout::after {
            content: "Log out";
            font-size: 16px;
            color: #F6F1F1;
        }
        
        .options {
            padding: 0;
            justify-content: center;
        }
        
        .img11 {
            margin-right: 50%;
        }
        
        .nested {
            padding-left: 0;
        }
        
        .separate {
            margin: 10px 15px;
        }

        .promote{
               font-size: 40px;
          }
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
          }
    }
</style>