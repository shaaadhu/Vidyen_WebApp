 <html>

 <head>
     <title>Setup Required</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>

 <body style="font-family: Arial; padding: 50px; background: #f5f5f5;">
     <!-- <div style="max-width: 700px; margin: 0 auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h2 style="color: #d32f2f; margin-bottom: 20px;">⚠ Not Eligible</h2>
            
            <div style="background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 20px 0;">
                <strong>No <?= $certName ?> Found:</strong> You do not have an eligible <?= $certName ?> for certificate generation.
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="participant_certificates.php" style="color: #666; text-decoration: none;">← Back to Certificates</a>
            </div>
        </div> -->




     <div style="max-width: 700px; margin: 0 auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
         <h2 style="color: #d32f2f; margin-bottom: 20px;">⚠ <?= $errorTitle ?></h2>

         <div style="background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 20px 0;">
             <?= $errorMessage ?>
         </div>

         <?php
            if ($imagePath) {
                if ($action == 'downloadGenerated') {
            ?>
                 <h3 style="color: #333; margin-top: 30px;">Option 1: Upload JPEG/JPG Image (Easiest)</h3>

                 <div style="background: #e3f2fd; padding: 20px; margin: 15px 0; border-radius: 5px;">
                     <p><strong>If you have the certificate as JPEG/JPG:</strong></p>
                     <ol>
                         <li>Click the upload button below</li>
                         <li>Select your certificate JPEG/JPG file</li>
                         <li>Done! It will be saved as <code><?= $certName . '.jpg' ?></code></li>
                     </ol>
                     <a href="index.php?controller=certificate&action=uploadAction" style="display: inline-block; background: #4CAF50; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 10px;">
                         📤 Upload JPEG Image →
                     </a>
                 </div>

                 <h3 style="color: #333; margin-top: 30px;">Option 2: Manual File Copy</h3>

                 <div style="background: #e8f5e9; padding: 20px; margin: 15px 0; border-radius: 5px;">
                     <p>Copy your certificate image file to:</p>
                     <code style="display: block; background: white; padding: 10px; border-radius: 5px; margin: 10px 0;">
                         certificates/<?= $certName . '.jpg' ?>
                     </code>
                     <p style="margin-top: 15px;"><small>Or use .png or .jpeg extension</small></p>
                 </div>

                 <div style="background: #f5f5f5; padding: 15px; margin: 20px 0; border-radius: 5px; font-size: 14px;">
                     <strong>Accepted formats:</strong>
                     <ul style="margin: 10px 0;">
                         <li><?= $certName . '.jpg' ?></li>
                         <li><?= $certName . '.jpeg' ?></li>
                         <li><?= $certName . '.png' ?></li>
                     </ul>
                 </div>




                 
         <?php
                }
                else{
            ?>
            <div style="background: #e8f5e9; padding: 20px; margin: 15px 0; border-radius: 5px;">
                <p>Upload your certificate image file to:</p>
                <code style="display: block; background: white; padding: 10px; border-radius: 5px; margin: 10px 0;">
                    certificates/<?= $certName . '.jpg' ?>
                </code>
            </div>
            <?php
                }
            }
            ?>
         <div style="text-align: center; margin-top: 30px;">
             <a href="index.php?controller=participant&action=certificates_view" style="color: #666; text-decoration: none;">← Back to Certificates</a>
         </div>
     </div>
 </body>

 </html>