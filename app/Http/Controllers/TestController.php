<?php
namespace App\Http\Controllers;

class TestController extends Controller{
    public function index(){

        $jsonString = '{
      "name": "John Doe",
      "age": 30,
      "city": "New York"
    }';
        $userInput = "fdsa";
        $userWebsite = "sad";
        $jsonData = json_decode($jsonString);

        $prompt = <<<EOD
        Create Sustainability Score for the Company/Brand " + $userInput + " with their official website " + $userWebsite + " Following the guidelines: Use Defined Sustainability Criteria and Weights: Environmental Impact (e.g., carbon footprint, water usage, waste reduction) - This is a crucial factor as sustainable businesses minimize their environmental footprint. (Weight: 30%) Labor Practices (e.g., fair wages, safe working conditions) - Ethical treatment of workers is a key sustainability concern. (Weight: 20%) Sustainable Materials (e.g., recycled content, organic materials) - Using eco-friendly materials reduces environmental impact. (Weight: 20%) Circular Economy (e.g., take-back programs, product lifetime extension) - A circular economy minimizes waste by keeping products and materials in use. (Weight: 15%) Transparency (e.g., sustainability reports, third-party certifications) - Open communication about sustainability efforts builds trust. (Weight: 15%) You can assign weights to each criterion based on your priorities and the brand's industry. For instance, for an apparel brand, sustainable materials might be more important than for a software company.
        Gather Brand Information: Check the " + $userInput + " website for sustainability reports, policies, and initiatives. Research independent reviews and ratings from credible organizations. Look for news articles about the " + $userInput
            + " sustainability practices. Score Each Criterion: Develop a scoring system (0-10 points) for each criterion based on the level of information you find. No information available = 0 points; Limited information or some sustainable practices
            = 3-5 points; Strong sustainability practices = 7-8 points; Leading sustainability practices = 9-10 points; Calculate the Overall Score: Multiply each criterion\'s score by its weight and sum the results. Divide the total by the sum of all weights (100 in this case) and multiply by 100 to convert it to a 0-100 scale. The full response should be formatted in HTML Syntax, with all the styling. Include tables, Headings starting from H2 to H4, no markdown at all! Please for each score, write comprehensive, proffesional long and detailed process of evaluation about the calculation
            process for " + $userInput + " providing valuable insight for the reader. Each score Highlight at the end of each section with format: <div id=score>Score [Value]/[Max Value]</div>; Overall Score Place at the top of the Response, wrapped in <div id=total-score>Overall Score: [Value]/[Max value]. Add Section About the Potential Improvements for the company to implement to get better results. At the end of the response,
                        include the hyperlinks in the relevant format in HTML List, using `|` as separator, providing Further Exploration Resources.
        EOD;
        $paramsObj = array(
            "contents" => array([
                "parts" => array([
                    "text" => $prompt
                ])
            ]),
            "safetySettings" => array([
                "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                "threshold"=> "BLOCK_ONLY_HIGH"
            ]),
            "generationConfig" => array(
                "stopSequences"=>array(["Title"]),
                "temperature"=> 0.5,
                "top_p"=>0.5,
                "top_k"=> 10,
                "max_output_tokens"=> 8192
            )
        );
        $body_ewr =  json_encode(array('params' => json_encode($paramsObj)));

        return json_encode(array('message' => $body_ewr)); // Output: John Doe
    }
}
