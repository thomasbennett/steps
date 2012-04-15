<?php

/**
 * Description
 *
 * @author
 * @copyright ioStudio
 * @package
 * @subpackage
 * @version
 *
 */

class Topschool
{
  protected $_uri = 'https://nossi.topschoollive.com/BasicFeed/PostData.aspx';
  protected $_importertype = 'iostudios';
  protected $_importercategory = 'password#';
  protected $_institution = 'Nossi+College+of+Art';
  protected $_campaign = 'Internet';
  protected $_country = 'United+States';
  
  protected $_firstname;
  protected $_lastname;
  protected $_email;
  protected $_homephone;
  protected $_add1;
  protected $_add2;
  protected $_city;
  protected $_state;
  protected $_zip;
  protected $_poi;
  protected $_note;
  protected $_birth_date;
  protected $_gender;
  protected $_ethnicity;
  protected $_program_code;
  protected $_delivery_mode;
  protected $_admissions_stage;
  protected $_poi_start_date;
  protected $_poi_start_term;
  protected $_lead_source;
  protected $_prospect_status;
  protected $_status_reason_code;
  protected $_second_email;
  protected $_other_phone;
  protected $_lead_provider;
  protected $_external_reference;
  protected $_admission_advisor;
  protected $_degree_received;
  protected $_return_email;
  protected $_redirect;
  protected $_redirect_success;
  protected $_redirect_warning;
  protected $_redirect_error;

  /**
   * Submits the request to topschool
   */
  public function submit()
  {
    $parameters = array();
    $parameters[] = sprintf('ins=%s',$this->_institution);
    $parameters[] = sprintf('pa=%s','2%2e0');
    $parameters[] = sprintf('importertype=%s',$this->_importertype);
    $parameters[] = sprintf('importercategory=%s',urlencode($this->_importercategory));
    $parameters[] = sprintf('Campaign=%s',$this->_campaign);
    $parameters[] = sprintf('firstname=%s',$this->_firstname);
    $parameters[] = sprintf('lastname=%s',$this->_lastname);
    $parameters[] = sprintf('email=%s',$this->_email);

    if (!is_null($this->_add1) && !is_null($this->_city) && !is_null($this->_state) && !is_null($this->_zip))
    {
      $parameters[] = sprintf('add1=%s',urlencode($this->_add1));
      if (!is_null($this->_add2))
      {
        $parameters[] = sprintf('add2=%s',urlencode($this->_add2));
      }
      $parameters[] = sprintf('city=%s',urlencode($this->_city));
      $parameters[] = sprintf('stpro=%s',urlencode($this->_state));
      $parameters[] = sprintf('pc=%s',urlencode($this->_zip));
      $parameters[] = sprintf('co=%s',$this->_country);
    }

    if (!is_null($this->_homephone))
    {
      $parameters[] = sprintf('homephone=%s',$this->_homephone);
    }

    if (!is_null($this->_birth_date))
    {
      $parameters[] = sprintf('bd=%s',$this->_birth_date);
    }

    if (!is_null($this->_gender))
    {
      $parameters[] = sprintf('gen=%s',$this->_gender);
    }

    if (!is_null($this->_program_code))
    {
      $parameters[] = sprintf('programcode=%s',urlencode($this->_program_code));
    }

    if (!is_null($this->_delivery_mode))
    {
      $parameters[] = sprintf('deliverymode=%s',urlencode($this->_delivery_mode));
    }

    if (!is_null($this->_admissions_stage))
    {
      $parameters[] = sprintf('as=%s',urlencode($this->_admissions_stage));
    }

    if (!is_null($this->_poi_start_date))
    {
      $parameters[] = sprintf('poistartdate=%s',$this->_poi_start_date);
    }

    if (!is_null($this->_poi_start_term))
    {
      $parameters[] = sprintf('poist=%s',urlencode($this->_poi_start_term));
    }

    if (!is_null($this->_lead_source))
    {
      $parameters[] = sprintf('lso=%s',urlencode($this->_lead_source));
    }

    if (!is_null($this->_prospect_status))
    {
      $parameters[] = sprintf('status=%s',urlencode($this->_prospect_status));
    }

    if (!is_null($this->_status_reason_code))
    {
      $parameters[] = sprintf('statusreason=%s',urlencode($this->_status_reason_code));
    }

    if (!is_null($this->_second_email))
    {
      $parameters[] = sprintf('secondemail=%s',urlencode($this->_second_email));
    }

    if (!is_null($this->_other_phone))
    {
      $parameters[] = sprintf('otherphone=%s',urlencode($this->_other_phone));
    }

    if (!is_null($this->_lead_provider))
    {
      $parameters[] = sprintf('leadpro=%s',urlencode($this->_lead_provider));
    }

    if (!is_null($this->_external_reference))
    {
      $parameters[] = sprintf('externalreference=%s',urlencode($this->_external_reference));
    }

    if (!is_null($this->_admission_advisor))
    {
      $parameters[] = sprintf('aa=%s',urlencode($this->_admission_advisor));
    }

    if (!is_null($this->_degree_received))
    {
      $parameters[] = sprintf('degrcvd=%s',urlencode($this->_degree_received));
    }

    if (!is_null($this->_return_email))
    {
      $parameters[] = sprintf('rem=%s',urlencode($this->_return_email));
    }

    if (!is_null($this->_redirect))
    {
      $parameters[] = sprintf('rd=%s',urlencode($this->_redirect));
    }

    if (!is_null($this->_redirect_success))
    {
      $parameters[] = sprintf('rds=%s',urlencode($this->_redirect_success));
    }

    if (!is_null($this->_redirect_warning))
    {
      $parameters[] = sprintf('rdw=%s',urlencode($this->_redirect_warning));
    }

    if (!is_null($this->_redirect_error))
    {
      $parameters[] = sprintf('rde=%s',urlencode($this->_redirect_error));
    }

    if (!is_null($this->_note))
    {
      $parameters[] = sprintf('note=%s',urlencode($this->_note));
    }

    $url = $this->_uri . '?' . implode('&', $parameters);

//    die(var_dump($url,$parameters));

    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_RETURNTRANSFER => true,
    ));
    $results = curl_exec($ch);
    curl_close($ch);
    return $results;
  }

  /**
   * Institution Name
   * 
   * URL Code(s): ins
   * Required:    Y
   * Notes:       Must match existing Institution in SLM
   * Example:     ins=mycollege
   *
   * @param string $ins
   * @return Topschool
   */
  public function setInstitutionName($ins)
  {
    $this->_institution = $ins;
    return $this;
  }

  public function setIns($ins)
  {
    return $this->setInstitutionName($ins);
  }

  /**
   * Version
   * 
   * URL Code(s): parameter, pa
   * Required:    Y
   * Notes:       Must match version number – currently 2.0, this should be in
   *              ascii format “2%2e0”. If set to 1.0 or not included, the landing
   *              pages will use the deprecated landing page functionality.
   * Example:     pa=2%2e0
   *
   * @param string $version
   * @return Topschool
   */
  public function setVersion($version)
  {
    $this->_version = $version;
    return $this;
  }

  /**
   * First Name
   *
   * URL Code(s): firstname, fn
   * Required:    Y
   * Notes:       Free Text
   * Example:     firstname=John
   *
   * @param string $firstname
   * @return Topschool
   */
  public function setFirstname($firstname)
  {
    $this->_firstname = $firstname;
    return $this;
  }

  public function setFn($fn)
  {
    return $this->setFirstname($fn);
  }
  
  /**
   * Last Name
   * 
   * URL Code(s): lastname, ln
   * Required:    Y
   * Notes:       Free text
   * Example:     lastname=Doe
   *
   * @param string $lastname
   * @return Topschool
   */
  public function setLastname($lastname)
  {
    $this->_lastname = $lastname;
    return $this;
  }

  public function setLn($ln)
  {
    return $this->setLastname($ln);
  }

  /**
   * Prospect Status
   *
   * URL Code(s): status
   * Required:    N
   * Notes:       SLM Status Value – must be hardcoded in 3 rd party web site
   * Example:     status=in+process
   *
   * @param string $status
   * @return Topschool 
   */
  public function setProspectStatus($status)
  {
    $this->_prospect_status = $status;
    return $this;
  }

  public function setStatus($status)
  {
    return $this->setProspectStatus($status);
  }

  /**
   * Status Reason Code
   *
   * URL Code(s): statusreason
   * Required:    N
   * Notes:       This must match the SLM reason code values. This does not need
   *              to be case sensitive.
   * Example:     Statusreason=bad+address
   *
   * @param string $code
   * @return Topschool
   */
  public function setStatusReasonCode($code)
  {
    $this->_status_reason_code = $code;
    return $this;
  }

  public function setStatusreason($statusreason)
  {
    return $this->setStatusReasonCode($statusreason);
  }

  /**
   * Email
   *
   * URL Code(s): email, em
   * Required:    Y
   * Notes:       format a@b.com
   * Example:     email=john.doe@exapmle.com
   *
   * @param string $email
   * @return Topschool
   */
  public function setEmail($email)
  {
    $this->_email = $email;
    return $this;
  }

  public function setEm($email)
  {
    return $this->setEmail($email);
  }

  /**
   * Second Email
   *
   * URL Code(s): secondemail
   * Required:    N
   * Notes:       format a@b.com
   * Example:     secondemail=john.doe@exapmle.com
   *
   * @param string $email
   * @return Topschool
   */
  public function setSecondemail($email)
  {
    $this->_second_email = $email;
    return $this;
  }

  /**
   * Address 1
   *
   * URL Code(s): add1
   * Required:    N
   * Notes:       Free text. This is part of the address collection set.
   * Example:     add1=123+Main St.
   *
   * @param string $add1
   * @return Topschool
   */
  public function setAdd1($add1)
  {
    $this->_add1 = $add1;
    return $this;
  }

  /**
   * Address 2
   *
   * URL Code(s): add2
   * Required:    N
   * Notes:       Free text. This is part of the address collection set.
   * Example:     add2=apt+B
   *
   * @param string $address
   * @return Topschool
   */
  public function setAdd2($address)
  {
    $this->_add2 = $address;
    return $this;
  }

  /**
   * City
   * 
   * URL Code(s): city
   * Required:    N
   * Notes:       Free text. This is part of the address collection set.
   * Example:     city=Denver
   *
   * @param string $city
   * @return Topschool
   */
  public function setCity($city)
  {
    $this->_city = $city;
    return $this;
  }

  /**
   * State/Province
   * 
   * URL Code(s): stpro
   * Required:    N
   * Notes:       Must match standard two letter state names as shown in the
   *              TopSchool UI, or free text for province. This is part of the
   *              address collection set.
   * Example:     stpro=CO
   *
   * @param string $state
   * @return Topschool
   */
  public function setState($state)
  {
    $this->_state = $state;
    return $this;
  }

  public function setStpro($stpro)
  {
    return $this->setState($stpro);
  }

  /**
   * Postal Code
   * 
   * URL Code(s): pc
   * Required:    N
   * Notes:       ZIP Code or other postal code. This is part of the address
   *              collection set.
   * Example:     pc=80237
   *
   * @param string $zip
   * @return Topschool
   */
  public function setZip($zip)
  {
    $this->_zip = $zip;
    return $this;
  }

  public function setPc($pc)
  {
    return $this->setZip($pc);
  }

  /**
   * Country
   *
   * URL Code(s): co
   * Required:    N
   * Notes:       Must match the country names as shown in the TopSchool UI or by
   *              using a country code (see Country Codes at the end of this document).
   *              If the country does not match, it will not be saved. This is part
   *              of the address collection set.
   * Example:     co=United+States
   *
   * @param string $country
   * @return Topschool
   */
  public function setCountry($country)
  {
    $this->_country = $country;
    return $this;
  }

  public function setCo($co)
  {
      $this->setCountry($co);
  }

  /**
   * Primary Phone
   *
   * URL Code(s): homephone
   * Required:    N
   * Notes:       Numbers only. Will accept limited formatting e.g. (303)123-4567
   *              or 303-123-4567.
   * Example:     homephone=3037654321
   *
   * @param string $phone
   * @return Topschool
   */
  public function setHomephone($phone)
  {
    // replace all "-" and "." in the value, also if the first number is a 1
    // remove that
    $phone = preg_replace('/(-|\.|^1)/','',$phone);
    $this->_homephone = $phone;
    return $this;
  }

  /**
   * Other Phone
   *
   * URL Code(s): otherphone
   * Required:    N
   * Notes:       Numbers only. Will accept limited formatting e.g. (303)123-4567
   *              or 303-123-4567.
   * Example:     otherphone=3037654321
   *
   * @param string $phone
   * @return Topschool
   */
  public function setOtherphone($phone)
  {
    // replace all "-" and "." in the value, also if the first number is a 1
    // remove that
    $phone = preg_replace('/(-|\.|^1)/','',$phone);
    $this->_other_phone = $phone;
    return $this;
  }

  /**
   * Program of Interest
   *
   * URL Code(s): poi
   * Required:    N
   * Notes:       Must match the name of a Program Version in SLM
   * Example:     poi=program+name
   *
   * @param string $poi
   * @return Topschool
   */
  public function setPoi($poi)
  {
    $this->_poi = $poi;
    return $this;
  }

  /**
   * Note
   *
   * URL Code(s): note
   * Required:    N
   * Notes:       Free test
   * Example:     note=whatever
   *
   * @param string $note
   * @return Topschool
   */
  public function setNote($note)
  {
    $this->_note = $note;
    return $this;
  }

  /**
   * Birth Date
   *
   * URL Code(s): bd
   * Required:    N
   * Notes:       Format is mm.dd.yyyy
   * Example:     bd=12.12.1960
   *
   * @param string $bd
   * @return Topschool
   */
  public function setBirthDate($bd)
  {
    $this->_birth_date = $bd;
    return $this;
  }

  public function setBd($bd)
  {
    return $this->setBirthDate($bd);
  }

  /**
   * Gender
   *
   * URL Code(s): gen
   * Required:    N
   * Notes:       M, F, or U (U = undeclared)
   * Example:     gen=M
   *
   * @param string $gen
   * @return Topschool
   */
  public function setGender($gen)
  {
    $this->_gender = $gen;
    return $this;
  }

  public function setGen($gen)
  {
    return $this->setGender($gen);
  }

  /**
   * Ethnicity
   *
   * URL Code(s): ethn
   * Required:    N
   * Notes:       The following values on the left which can be used as a parmeter
   *              value correspond to the values on the right which are in TopSchool
   *              (as designated by the DoE).
   *              hispanic, latin -> HispanicOrLatino
   *              White, cauc -> White Two,
   *              multiple -> TwoOrMoreRaces
   *              Black, africa -> BlackOrAfricanAmerican
   *              Asia -> Asian Hawaii,
   *              pacific -> NativeHawaiianOrPacificIslander
   *              Indian, Alaska, native -> AmericanIndianOrAlaskaNative
   *              Anything else -> RaceAndEthnicityUnknown
   * Example:     ethn=hispanic
   *
   * @param string $ethn
   * @return Topschool
   */
  public function setEthnicity($ethn)
  {
    $this->_ethnicity = $ethn;
    return $this;
  }

  public function setEthn($ethn)
  {
    return $this->setEthnicity($ethn);
  }

  /**
   * Program Code
   * 
   * URL Code(s): programcode
   * Required:    N
   * Notes:       SLM Code Value – must be hardcoded in 3 rd party web site
   * Example:     programcode=abc123
   *
   * @param string $programcode
   * @return Topschool
   */
  public function setProgramcode($programcode)
  {
    $this->_program_code = $programcode;
    return $this;
  }

  /**
   * Delivery Mode
   * 
   * URL Code(s): deliverymode
   * Required:    N
   * Notes:       This should match the delivery mode in SLM. If not specified,
   *              the transaction will save without the delivery mode
   * Example:     deliverymode=delivery+mode
   *
   * @param string $deliverymode
   * @return Topschool
   */
  public function setDeliverymode($deliverymode)
  {
    $this->_delivery_mode;
    return $this;
  }

  /**
   * Admissions State
   * 
   * URL Code(s): as
   * Required:    N
   * Notes:       SLM Stage Value – must be hardcoded in 3rd party web site.
   * Example:     as=first+meeting
   *
   * @param string $as
   * @return Topschool
   */
  public function setAdmissionsStage($as)
  {
    $this->_admissions_stage = $as;
    return $this;
  }

  public function setAs($as)
  {
    return $this->setAdmissionsStage($as);
  }

  /**
   * Program of Insterst Start Date
   * 
   * URL Code(s): poistartdate, poisd
   * Required:    N
   * Notes:       Format is mm.dd.yyyy
   * Example:     poistartdate=5.1.2009
   *
   * @param string $poistartdate
   * @return Topschool
   */
  public function setPoiStartDate($poistartdate)
  {
    $this->_poi_start_date = $poistartdate;
    return $this;
  }

  /**
   * Program of Interest Start Term
   * 
   * URL Code(s): poist
   * Required:    N
   * Notes:       Must match existing term names in SLM.
   * Example:     poist=summerterm2011
   *
   * @param string $poist
   * @return Topschool
   */
  public function setPoiStartTerm($poist)
  {
    $this->_poi_start_term = $poist;
    return $this;
  }

  public function setPoist($poist)
  {
      return $this->setPoiStartTerm($poist);
  }

  /**
   * Lead Source
   *
   * URL Code(s): lso
   * Required:    N
   * Notes:       This should match the lead source in SLM. If not specified,
   *              the transaction will save without the lead source.
   * Example:     lso=whatever+you+want
   *
   * @param string $lso
   * @return Topschool
   */
  public function setLeadSource($lso)
  {
    $this->_lead_source = $lso;
    return $this;
  }

  public function setLso($lso)
  {
      return $this->setLeadSource($lso);
  }

  /**
   * Lead Provider
   *
   * URL Code(s): leadpro
   * Required:    N
   * Notes:       This should match the lead provider in SLM. If not specified,
   *              the transaction will save without the lead provider.
   * Example: Leadpro=whatever+you+want
   *
   * @param string $lead_provider
   * @return Topschool
   */
  public function setLeadProvider($lead_provider)
  {
    $this->_lead_provider = $lead_provider;
    return $this;
  }

  public function setLeadpro($leadpro)
  {
    return $this->setLeadProvider($leadpro);
  }

  /**
   * Campaign
   *
   * URL Code(s): campaign, ca
   * Required:    Y
   * Notes:       Must match existing Campaign in SLM - normally hardcoded in 3rd
   *              party web site.
   * Example:     campaign=Internet
   *
   * @param string $campaign
   * @return Topschool
   */
  public function setCampaign($campaign)
  {
    $this->_campaign = $campaign;
    return $this;
  }

  public function setCa($ca)
  {
    return $this->setCampaign($ca);
  }

  /**
   * External Reference
   *
   * URL Code(s): externalreference
   * Required:    N
   * Notes:       Free text
   * Example:     externalreference=abc123
   *
   * @param string $external_reference
   * @return Topschool
   */
  public function setExternalreference($external_reference)
  {
    $this->_external_reference = $external_reference;
    return $this;
  }

  /**
   * Admission Advisor
   *
   * URL Code(s): aa
   * Required:    N
   * Notes:       Must match SLM Administrative Advisor – must be hardcoded in 3rd
   *              party web site. Format is firstname+lastname.
   * Example: aa=Mary+Smith
   *
   * @param string $admission_advisor
   * @return Topschool
   */
  public function setAdmissionAdvisor($admission_advisor)
  {
    $this->_admission_advisor = $admission_advisor;
    return $this;
  }

  public function setAa($aa)
  {
    return $this->setAdmissionAdvisor($aa);
  }

  /**
   * Degree Received
   *
   * URL Code(s): degrcvd
   * Required:    N
   * Notes:       Free text
   * Example:     degrcvd=BA
   *
   * @param string $degree_received
   * @return Topschool
   */
  public function setDegreeReceived($degree_received)
  {
    $this->_degree_received = $degree_received;
    return $this;
  }

  public function setDegrcvd($degrcvd)
  {
    return $this->setDegreeReceived($degrcvd);
  }

  /**
   * Return Email
   * 
   * URL Code(s): rem
   * Required:    N
   * Notes:       Format is a@b.com. This value should be hardcoded in the 3rd
   *              paty website.
   * Example:     rem=originator@3rdparty.com
   *
   * @param string $return_email
   * @return Topschool
   */
  public function setReturnEmail($return_email)
  {
    $this->_return_email = $return_email;
    return $this;
  }

  public function setRem($rem)
  {
    return $this->setReturnEmail($rem);
  }

  /**
   * Redirect
   *
   * URL Code(s): rd
   * Required:    N
   * Notes:       If redirects should be used in response to the GET, this must
   *              be set to true. If not present or set to false, the success/error
   *              handling statuses will be sent.
   * Example:     rd=true
   *
   * @param string $redirect
   * @return Topschool
   */
  public function setRedirect($redirect)
  {
    $this->_redirect = $redirect;
    return $this;
  }

  public function setRd($rd)
  {
    return $this->setRedirect($rd);
  }

  /**
   * Redirect Success
   *
   * URL Code(s): rds
   * Required:    N
   * Notes:
   * Example:
   *
   * @param string $redirect_success
   * @return Topschool
   */
  public function setRedirectSuccess($redirect_success)
  {
    $this->_redirect_success = $redirect_success;
    return $this;
  }

  public function setRds($rds)
  {
    return $this->setRedirectSuccess($rds);
  }

  /**
   * Redirect Warning
   *
   * URL Code(s): rdw
   * Required:    N
   * Notes:
   * Example:
   *
   * @param string $redirect_warning
   * @return Topschool
   */
  public function setRedirectWarning($redirect_warning)
  {
    $this->_redirect_warning = $redirect_warning;
    return $this;
  }

  public function setRdw($rdw)
  {
    return $this->setRedirectWarning($rdw);
  }

  /**
   * Redirect Error
   *
   * URL Code(s): rde
   * Required:    N
   * Notes:
   * Example: 
   *
   * @param string $redirect_error
   * @return Topschool 
   */
  public function setRedirectError($redirect_error)
  {
    $this->_redirect_error = $redirect_error;
    return $this;
  }

  public function setRde($rde)
  {
    return $this->setRedirectError($rde);
  }

  public function toArray()
  {
    return get_object_vars($this);
  }
}