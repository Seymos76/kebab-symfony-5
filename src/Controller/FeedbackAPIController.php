<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FeedbackAPIController extends AbstractController
{
    public function getAllFeedbacks()
    {
        // get feedbacks from database
        // serializer feedbacks
        // return json
    }

    public function postFeedback()
    {
        // deserialize feedback
        // validate data
        // save to dabatase
        // return json
    }

    public function editFeedback()
    {
        // deserialize feedback
        // validate data
        // get feedback from database
        // replace feedback
        // save to database
        // return json
    }

    public function deleteFeedback()
    {
        // get feedback from database
        // delete feedback
        // save database
        // return json
    }
}