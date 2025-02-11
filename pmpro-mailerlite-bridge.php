<?php
/* 
 * 
 * Mailerlite Bridge to PaidMembership Pro
 * By https://github.com/vikcon
 *
 *  */
function add_pmpro_member_to_mailerlite($level_id, $user_id) {
    // Define your MailerLite API Key
    $api_key = '####';

    // Define MailerLite Group IDs
    $free_members_group_id = '###';
    $paid_members_group_id = '###';

    // Define Membership Levels (Replace with your actual level IDs)
    $free_membership_id = 1; // Free Member
    $paid_membership_id = 2; // Paid Member
    $paid_org_membership_id = 3; // Paid Organization Member

    // Get user data
    $user = get_userdata($user_id);
    $email = $user->user_email;

    // Determine which group to add the user to
    if ($level_id == $free_membership_id) {
        $group_id = $free_members_group_id;
    } elseif ($level_id == $paid_membership_id || $level_id == $paid_org_membership_id) {
        $group_id = $paid_members_group_id;
    } else {
        return; // Exit if membership level doesn't match
    }

    // MailerLite API URL
    $url = "https://api.mailerlite.com/api/v2/groups/{$group_id}/subscribers";

    // Data to send
    $data = array(
        "email" => $email,
        "resubscribe" => true
    );

    // API request arguments
    $args = array(
        "body" => json_encode($data),
        "headers" => array(
            "Content-Type" => "application/json",
            "X-MailerLite-ApiKey" => $api_key
        ),
        "method" => "POST"
    );

    // Send request to MailerLite
    $response = wp_remote_post($url, $args);

    // Debugging (Optional: Remove in production)
    if (is_wp_error($response)) {
        error_log("MailerLite API Error: " . $response->get_error_message());
    } else {
        error_log("User added to MailerLite group ($group_id): " . $email);
    }
}
}
add_action('pmpro_after_change_membership_level', 'add_pmpro_member_to_mailerlite', 10, 2);
?>