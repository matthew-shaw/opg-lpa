<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller\Authenticated\Lpa;

use Application\Controller\AbstractLpaController;
use Opg\Lpa\DataModel\Lpa\Lpa;

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class PaymentController extends AbstractLpaController
{
    /**
     * Gathers the LPA information and forwards the payment request to Worldpay
     * Uses the Omnipay purchase interface to obtain a URL to which to redirect
     * the user for payment.
     */
    public function indexAction()
    {
        $paymentService = $this->getServiceLocator()->get('Payment');

        $options = $paymentService->getOptions($this->getLpa());
        
        $response = 
            $paymentService
                 ->getGateway()
                 ->purchase($options)
                 ->send();
        
        $redirectUrl = 
            $this->getRedirectUrl(
                $response->getData()->reference,
                $this->getLpa()->id,
                $this->getRequest()->getUri()
            );
        
        $this->redirect()->toUrl($redirectUrl);
    }
    
    public function successAction()
    {
        $paymentService = $this->getServiceLocator()->get('Payment');
        
        $params = $this->getSuccessParams();
        
        $lpaId = $this->getLpa()->id;
        
        $paymentService->verifyMacString($params, $lpaId);
        $paymentService->verifyOrderKey($params, $lpaId);
        
        $paymentService->updateLpa($params);
    }
    
    /**
     * Helper function to verify and extract the success params
     * 
     * @return array
     */
    private function getSuccessParams()
    {
        $params = [
            'paymentStatus' => null,
            'orderKey' => null,
            'paymentAmount' => null,
            'paymentCurrency' => null,
            'mac' => null
        ];
        
        foreach ($params as $key => &$value) {
            if ($this->request->getQuery($key) == null) {
                throw new \Exception(
                    'Invalid success response from Worldpay. ' .
                    'Expected ' . $key . ' parameter was not found. ' .
                    $_SERVER["REQUEST_URI"]
                );
            }
            $value = $this->request->getQuery($key);
        }
        
        if ($params['paymentStatus'] != 'AUTHORISED') {
            throw new \Exception(
                'Invalid success response from Worldpay. ' .
                'paymentStatus was ' . $params['paymentStatus'] . ' (expected AUTHORISED)'
            );
        }
        
        return $params;
    }
    
    public function failureAction()
    {
        echo __FUNCTION__;
    }
    
    public function cancelAction()
    {
        echo __FUNCTION__;
    }
    
    public function pendingAction()
    {
        echo __FUNCTION__;
    }
    
    /**
     * Helper function to construct the Worldpay redirect URL
     *
     * @param string $baseUrl
     * @param string $lpaId
     * @param Uri $uri
     * @return string
     */
    public function getRedirectUrl($baseUrl, $lpaId, $uri)
    {
        $redirectUrl =
            $baseUrl .
                '&successURL=' .  $this->getCallbackEndpoint('success', $lpaId, $uri) .
                '&pendingURL=' . $this->getCallbackEndpoint('pending', $lpaId, $uri) .
                '&failureURL=' . $this->getCallbackEndpoint('failure', $lpaId, $uri) .
                '&cancelURL=' . $this->getCallbackEndpoint('cancel', $lpaId, $uri);
    
        return $redirectUrl;
    }
    
    /**
     * Helper function to construct the callback URLs
     *
     * @param string $type
     * @param string $lpaId
     * @param Uri $uri
     * @return string
     */
    public function getCallbackEndpoint($type, $lpaId, $uri)
    {
        $baseUri = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());
    
        return $baseUri . $this->url()->fromRoute(
            'lpa/payment/return/' . $type,
            ['lpa-id' => $lpaId]
        );
    }
    
    /**
     * Temporary helper function to get a dummy LPA
     * 
     * @return \Opg\Lpa\DataModel\Lpa\Lpa
     */
    public function getLpa()
    {
        return new Lpa('{
            "id": 70436149975,
            "createdAt": "2014-12-13T12:51:44+00:00",
            "updatedAt": "2014-12-17T20:56:23+00:00",
            "user": "680cc50c43c6ba65d535c6bf107ccf32",
            "repeatCaseNumber": null,
            "payment": {
                "reducedFeeReceivesBenefits": false,
                "reducedFeeAwardedDamages": true,
                "reducedFeeLowIncome": false,
                "reducedFeeUniversalCredit": false,
                "amount": 110,
                "method": "card",
                "phone": {
                    "number": "+845 197 853179"
                },
                "reference": "j7txin9qz05py8re0ie7pwfm50l7vs24",
                "date": "2014-12-17T20:56:23+00:00"
            },
            "whoAreYouAnswered": true,
            "locked": true,
            "seed": null,
            "document": {
                "type": "property-and-financial",
                "donor": {
                    "name": {
                        "title": "Mrs",
                        "first": "Monty",
                        "last": "Acosta"
                    },
                    "otherNames": null,
                    "address": {
                        "address1": "499 London Road",
                        "address2": "Leicester",
                        "address3": "Leicestershire, England",
                        "postcode": "DN0Y 3BS"
                    },
                    "dob": {
                        "date": "1965-10-22T23:57:59+00:00"
                    },
                    "email": {
                        "address": "w93@isnrqcelz.net"
                    },
                    "canSign": true
                },
                "primaryAttorneys": [
                    {
                        "address": {
                            "address1": "981 Highfield Road",
                            "address2": "North Berwick",
                            "address3": "Lothian, Scotland",
                            "postcode": "DH46 0FC"
                        },
                        "email": {
                            "address": "ozuhs66@oo.co.uk"
                        },
                        "type": "human",
                        "name": {
                            "title": "Capt",
                            "first": "Hayden",
                            "last": "Santiago"
                        },
                        "dob": {
                            "date": "1979-05-25T22:14:11+00:00"
                        }
                    },
                    {
                        "address": {
                            "address1": "571 Church Lane",
                            "address2": "Somerton",
                            "address3": "Somerset, England",
                            "postcode": "WS0K 9UT"
                        },
                        "email": null,
                        "type": "human",
                        "name": {
                            "title": null,
                            "first": "Adrian",
                            "last": "Harmon"
                        },
                        "dob": {
                            "date": "1951-08-25T03:15:15+00:00"
                        }
                    },
                    {
                        "address": {
                            "address1": "947 Stanley Road",
                            "address2": "Beverley",
                            "address3": "East Riding of Yorkshire, England",
                            "postcode": "LS9 9FC"
                        },
                        "email": {
                            "address": "m8c5u9wx@hucmbesk.org.uk"
                        },
                        "type": "trust",
                        "name": "Loved Or Ltd.",
                        "number": "35OCFZBN"
                    }
                ],
                "certificateProvider": {
                    "name": {
                        "title": "Hon",
                        "first": "Aliyah",
                        "last": "Finley"
                    },
                    "address": {
                        "address1": "757 South Street",
                        "address2": "Stowmarket",
                        "address3": "Suffolk, England",
                        "postcode": "G82 5TS"
                    }
                },
                "peopleToNotify": [
            
                ],
                "instruction": "ley. The cubs were\r\nout, but Mother Wolf, at the back of the cave, knew by his\r\nbreathing that something was troubling her frog.\r\n\r\n\"What is it, Son?\" she said.\r\n\r\n\"Some bat\'s chatter of Shere Khan,\" he called back. \"I hunt\r\namong the plowed fields tonight,\" and he plunged downward through\r\nthe bushes, to the stream at the bottom of the valley. There he\r\nchecked, for he heard the yell of the Pack hunting, heard the\r\nbellow of a hunted Sambhur, and the snort as the buck turned at\r\nbay. Then there were wicked, bitter howls from the young wolves:\r\n\"Akela! Akela! Let the Lone Wolf show his strength. Room for\r\nthe leader of the Pack! Spring, Akela!\"\r\n\r\nThe Lone Wolf must have sprung and missed his hold, for Mowgli\r\nheard the snap of his teeth and then a yelp as the Sambhur knocked\r\nhim over with his forefoot.\r\n\r\nHe did not wait for anything more, but dashed on; and the\r\nyells grew fainter behind him as he ran into the croplands where\r\nthe villagers lived.\r\n\r\n\"Bagheera spoke truth,\" he panted, as he nestled down in some\r\ncattle fodder by the window of a hut. \"To-morrow is one day both\r\nfor Akela and for me.\"\r\n\r\nThen he pressed his face close to the window and watched the\r\nfire on the hearth. He saw the husbandman\'s wife get up and feed\r\nit in the night with black lumps. And when the morning came and\r\nthe mists were all white and cold, he saw the man\'s child pick up\r\na wicker pot plastered inside with earth, fill it with lumps of\r\nred-hot charcoal, put it under his blanket, and go out to tend the\r\ncows in the byre.\r\n\r\n\"Is that all?\" said Mowgli. \"If a cub can do it, there is\r\nnothing to fear.\" So he strode round the corner and met the boy,\r\ntook the pot from his hand, and disappeared into the mist while\r\nthe boy howled with fear.\r\n\r\n\"They are very like me,\" said Mowgli, blowing into the pot as\r\nhe had seen the woman do. \"This thing will die if I do not give\r\nit things to eat\"; and he dropped twigs and dried bark on the",
                    "preference": "n; and the\r\nyells grew fainter behind him as he ran into the croplands where\r\nthe villagers lived.\r\n\r\n\"Bagheera spoke truth,\" he panted, as he nestled down in some\r\ncattle fodder by the window of a hut. \"To-morrow is one day both\r\nfor Akela and for me.\"\r\n\r\nThen he pressed his face close to the window and watched the\r\nfire on the hearth. He saw the husbandman\'s wife get up and feed\r\nit in the night with black lumps. And when the morning came and\r\nthe mists were all white and cold, he saw the man\'s child pick up\r\na wicker pot plastered inside with earth, fill it with lumps of\r\nred-hot charcoal, put it under his blanket, and go out to tend the\r\ncows in the byre.\r\n\r\n\"Is that all?\" said Mowgli. \"If a cub can do it, there is\r\nnothing to fear.\" So he strode round the corner and met the boy,\r\ntook the pot from his hand, and disappeared into the mist while\r\nthe boy howled with fear.\r\n",
                    "primaryAttorneyDecisions": {
                    "how": "jointly",
                    "when": "now"
                },
                "replacementAttorneys": [
                {
                    "address": {
                    "address1": "125 Queensway",
                    "address2": "Stoke on Trent",
                    "address3": "Staffordshire, England",
                    "postcode": "ZE39 8LB"
                    },
                    "email": {
                    "address": "gdpd2xt@fmk.net"
                    },
                    "type": "human",
                    "name": {
                    "title": "Dr",
                    "first": "Rayyan",
                    "last": "Fry"
                    },
                    "dob": {
                    "date": "1996-07-21T10:52:56+00:00"
                    }
                },
                {
                    "address": {
                    "address1": "163 New Street",
                    "address2": "Langley Mill",
                    "address3": "Derbyshire, England",
                    "postcode": "TF3 9SC"
                    },
                    "email": {
                    "address": "20v5g@rvfwasgq.org.uk"
                    },
                    "type": "human",
                    "name": {
                    "title": "Hon",
                    "first": "Kyran",
                    "last": "Mooney"
                    },
                    "dob": {
                    "date": "1925-03-10T18:16:10+00:00"
                    }
                },
                {
                    "address": {
                    "address1": "98 Station Road",
                    "address2": "Aberfeldy",
                    "address3": "Perth and Kinross, Scotland",
                    "postcode": "HX1 7TN"
                    },
                    "email": null,
                    "type": "human",
                    "name": {
                    "title": "Capt",
                    "first": "Beatrice",
                    "last": "Taylor"
                    },
                    "dob": {
                    "date": "1996-09-19T20:09:54+00:00"
                    }
                }
                ],
                "replacementAttorneyDecisions": {
                "how": "depends",
                "when": "first",
                "howDetails": "bearlings,\" said Baloo, gravely shaking one leg after the other.\r\n\"Wow! I am sore. Kaa, we owe thee, I think, our lives--Bagheera\r\nand I.\"\r\n\r\n\"No matter. Where is the manling?\"\r\n\r\n\"Here, in a trap. I cannot climb out,\" cried Mowgli. The\r\ncurve of the broken dome was above his head.\r\n\r\n\"Take him away. He dances like Mao the Peacock. He will\r\ncrush our young,\" said the cobras inside.\r\n\r\n\"Hah!\" said Kaa with a chuckle, \"he has friends everywhere,\r\nthis manling. Stand back, manling. And hide you, O Poison\r\nPeople. I break down the wall.\"\r\n\r\nKaa looked carefully till he found a discolored crack in the\r\nmarble tracery showing a weak spot, made two or three light taps\r\nwith his head to get the distance, and then lifting up six feet of\r\nhis body clear of the ground, sent home half a dozen full-power\r\nsmashing blows, nose-first. The screen-work broke and fell away\r\nin a cloud of dust and rubbish, and Mowgli leaped through the\r\nopening and flung himself between Baloo and Bagheera--an arm\r\naround each big neck.\r\n\r\n\"Art thou hurt?\" said Baloo, hugging him softly.\r\n\r\n\"I am sore, hungry, and not a little bruised. But, oh, they\r\nhave handled ye grievously, my Brothers! Ye bleed.\"\r\n\r\n\"Others also,\" said Bagheera, licking his lips and looking at\r\nthe monkey-dead on the terrace and round the tank.\r\n\r\n\"It is nothing, it is nothing, if thou art safe, oh, my pride\r\nof all little frogs!\" whimpered Baloo.\r\n\r\n\"Of that we shall judge later,\" said Bagheera, in a dry voice\r\nthat Mowgli did not at all like. \"But here is Kaa to whom we owe\r\nthe battle and thou owest thy life. Thank him according to our\r\ncustoms, Mowgli.\"\r\n\r\nMowgli turned and saw the great Python\'s head swaying a foot\r\nabove his own.\r\n\r\n\"So this is the manling,\" said Kaa. \"",
                "whenDetails": null
                },
                "whoIsRegistering": [
                    0,
                    1,
                    2
                ],
                "correspondent": {
                "who": "attorney",
                "name": null,
                "company": "Loved Or Ltd.",
                "address": {
                "address1": "947 Stanley Road",
                "address2": "Beverley",
                "address3": "East Riding of Yorkshire, England",
                "postcode": "LS9 9FC"
                },
                "email": {
                "address": "m8c5u9wx@hucmbesk.org.uk"
                },
                "phone": {
                "number": "+696 121 684242"
                },
                "contactByPost": false,
                "contactInWelsh": true
                }
            }
        }');
    }
}
