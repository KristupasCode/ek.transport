<?php

// Function to calculate reward amount for a specific month
function calculateReward($investmentAmount, $rewardRate, $startDate, $duration, $paymentDay) {
    // Initialize variables
    $rewardNumber = 1;
    $investment = $investmentAmount;
    $totalReward = 0;
    $schedule = [['Reward Number', 'Reward Date', 'Investment Amount', 'Reward Amount', 'Total Reward', 'Yearly Reward Rate']];

    // Loop through duration
    for ($i = 0; $i < $duration; $i++) {
        // Calculate reward date
        $rewardDate = date("Y-m-d", strtotime("+$i months", strtotime($startDate)));
        $rewardDate = date("Y-m-$paymentDay", strtotime($rewardDate));

        // Calculate reward amount using "Actual/365" day count convention method
        $rewardAmount = $investment * $rewardRate / 12 / 365 * (strtotime($rewardDate) - strtotime(date("Y-m-01", strtotime($rewardDate))));
        $totalReward += $rewardAmount;

        // Add data to schedule
        $schedule[] = [$rewardNumber, $rewardDate, number_format($investment, 2), number_format($rewardAmount, 2), number_format($totalReward, 2), $rewardRate];

        // Increment reward number
        $rewardNumber++;

        // Update investment amount if reinvest is true
        $investment += $rewardAmount;
    }
    return $schedule;
}

//Example
$stakingStartDate = "2019-04-15";
$stakingDuration = 24.00000;
$rewardPaymentDay = 23;
$initialInvestment = 25;
$yearlyRewardRate = 10;
$reinvest = true;

$schedule = calculateReward($initialInvestment, $yearlyRewardRate, $stakingStartDate, $stakingDuration, $rewardPaymentDay);

// Open or create the output file
$fp = fopen("staking_schedule.csv", "w");

// Write the schedule array to the output file
foreach ($schedule as $fields) {
    fputcsv($fp, $fields);
}

// Close the output file
fclose($fp);

echo "File created successfully!";
