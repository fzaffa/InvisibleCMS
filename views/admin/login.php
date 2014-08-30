<!doctype>
<html>
<head>
    <style type="text/css">
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed,
        figure, figcaption, footer, header, hgroup,
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        body {
            margin:50px 0;
            padding:0;
            text-align: center;
        }
    input
    {
        border-radius: 3px;
        background: #FFFFFF;
        border: 1px solid #DBDBDB;
        height: 32px;
        font-size: 14px;
        line-height: 14px;
        vertical-align: middle;
        font-family: "OpenSans", sans-serif;
        font-weight: light;
        padding: 0 10px;
        min-width: 110px;
        color: #262626;
    }
    input:focus
    {
        border: 1px solid rgba(10,171,150,0.58);
        outline: none;
    }
    input.btn-green
    {
        background-color: rgb(10,171,150);
        border: none;
        color: white;
        font-family: Helvetica;
        font-size: 16px;
        color: #F5F5F5;
        line-height: 16px;

    }
    label
    {
        font-family: Helvetica, sans-serif;
        font-size: 16px;
        color: #0BAB97;
        line-height: 20px;
        font-weight: 100;
        width: 80px;
        display: inline-block;
    }
    div.form-field
    {

        display: table-cell;
    vertical-align: middle;
        height: 32px;
        padding: 5px;
        float: left;
        clear: both;
        text-align: right;
        width: auto;
        
    }
    .login-box
    {
        padding: 50px;
        margin: 0 auto;
        display: inline-block;
        border: 1px solid #dbdbdb;
        border-radius: 5px;

    }
</style>
</head>
<body>
<div class="login-box">
    <form method="post" action="/admin/login">
        <div class="form-field">
            <label>Username:</label>
            <input type="text" name="username" />
        </div>
        <div class="form-field">
            <label>Password:</label>
            <input type="password" name="password" />
        </div>
        <div class="form-field">
            <input type="submit" class="btn-green" name="login" value="Login"/>
        </div>
    </form>
</div>
</body>
</html>